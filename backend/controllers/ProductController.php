<?php

namespace backend\controllers;

use backend\models\ProductForm;
use common\models\Category;
use common\models\Product;
use Yii;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\UploadedFile;

class ProductController extends Controller
{
    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => Product::find()
        ]);

        return $this->render('index', ['dataProvider' => $dataProvider]);
    }

    public function actionCreate()
    {
        $model = new ProductForm();

        if ($model->load(Yii::$app->request->post())) {
            $model->images = UploadedFile::getInstances($model, 'images');
            if ($images_path = $model->upload()) {
                $product = new Product();
                $product->name = $model->name;
                $product->description = $model->description;
                $product->count = $model->count;
                $product->price = $model->price;
                $product->category_id = $model->category_id;
                $product->sub_category_id = $model->sub_category_id;
                $product->url_images = json_encode($images_path);
                if ($product->save()) {
                    Yii::$app->session->addFlash('success', 'Продукт сохранен');
                } else {
                    Yii::$app->session->addFlash('error', 'Ошибка сохранения продукта');
                }
                return $this->redirect(['/product/index']);
            }
        }

        $categories = Category::find()->all();
        $categories_array = [];
        foreach ($categories as $category) {
            $categories_array[$category->id] = $category->name;
        }

        return $this->render('create', [
            'model' => $model,
            'categories_array' => $categories_array,
            'initial_prev' => [],
            'image_conf' => [],
            'product_id' => ''
        ]);
    }

    public function actionView($id)
    {
        $product = Product::findOne(['id' => $id]);
        $model = new ProductForm();
        if ($product) {
            $url_images_tmp = json_decode($product->url_images);
            $url_images = [];
            foreach ($url_images_tmp as $images_tmp) {
                $url_images[] = '../../' . $images_tmp;
            }
            // die(var_dump($url_images));
            return $this->render('view', [
                'model' => $model,
                'product' => $product,
                'url_images' => $url_images,
            ]);
        } else {
            Yii::$app->session->addFlash('error', 'Продукт не найден');
        }
    }

    public function actionUpdate($id)
    {
        $product = Product::findOne(['id' => $id]);
        $model = new ProductForm();
        $model->id = $id;

        if ($model->load(Yii::$app->request->post())) {
            $model->images = UploadedFile::getInstances($model, 'images');
            if ($images_path = $model->upload()) {
                $product->name = $model->name;
                $product->description = $model->description;
                $product->count = $model->count;
                $product->price = $model->price;
                $product->category_id = $model->category_id;
                $product->sub_category_id = $model->sub_category_id;
                $product->url_images = json_encode($images_path);

                if ($product->save()) {
                    Yii::$app->session->addFlash('success', 'Продукт сохранен');
                } else {
                    Yii::$app->session->addFlash('error', 'Ошибка сохранения продукта');
                }
                return $this->redirect(['/product/index']);
            }
        }

        $model->name = $product->name;
        $model->description = $product->description;
        $model->count = $product->count;
        $model->price = $product->price;
        $model->category_id = $product->category_id;
        $model->sub_category_id = $product->sub_category_id;

        $categories = Category::find()->all();
        $categories_array = [];
        if ($categories) {
            foreach ($categories as $category) {
                $categories_array[$category->id] = $category->name;
            }
        }

        $url_images_tmp = json_decode($product->url_images);
        $url_images = [];
        $image_conf = [];
        if ($url_images_tmp) {
            foreach ($url_images_tmp as $images_tmp) {
                $url_images[] = '../../' . $images_tmp;

                $name_file = explode('/', $images_tmp);
                $image_conf[] =
                    [
                        'key' => $name_file[count($name_file) - 1],
                        'caption' => $name_file[count($name_file) - 1],
                        'size' => '',
                    ];
            }
        }
        // die(var_dump($image_conf));

        return $this->render('create', [
            'model' => $model,
            'categories_array' => $categories_array,
            'initial_prev' => $url_images,
            'image_conf' => $image_conf,
            'product_id' => $id
        ]);
    }

    public function actionDelete($id)
    {
        $product = Product::findOne(['id' => $id]);
        if ($product) {
            $url_images = json_decode($product->url_images);
            if ($product->delete()) {
                foreach ($url_images as $url_image) {
                    if (file_exists($url_image)) unlink($url_image);
                }

                Yii::$app->session->addFlash('success', 'Продукт удален');
            } else {
                Yii::$app->session->addFlash('error', 'Ошибка удаления продукта');
            }
        } else {
            Yii::$app->session->addFlash('error', 'Продукт не найден');
        }
        return $this->redirect(['/product/index']);
    }
}
