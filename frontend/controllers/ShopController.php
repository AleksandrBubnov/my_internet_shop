<?php

namespace frontend\controllers;

use backend\models\ProductForm;
use common\models\Basket;
use common\models\Order;
use common\models\Product;
use common\models\Promotion;
use Yii;
use yii\web\Controller;
use yii\web\Response;

class ShopController extends Controller
{
    public function actionIndex()
    {
        $promotions = Promotion::find()->all();
        $images_array = [];
        if ($promotions) {
            foreach ($promotions as $promotion) {
                // $name_file = explode('/', $promotion->url_image);

                // $images_array[] = Yii::getAlias('@uploads') . '\\' . $name_file[count($name_file) - 1];
                $images_array[] = $promotion->url_image;
            }
        }
        // $products = Product::find()->asArray()->all();
        $products = Product::find()->all();

        return $this->render('index', [
            'promotions' => $promotions,
            'products' => $products,
            'images_array' => $images_array,
        ]);
    }

    public function actionView($id)
    {
        // die(var_dump($id));
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

    public function actionPromotion_view($id)
    {
        $promotion = Promotion::findOne(['id' => $id]);
        if ($promotion) {
            return $this->render('promotion_view', [
                'promotion' => $promotion,
            ]);
        } else {
            Yii::$app->session->addFlash('error', 'Акция не найдена');
        }
    }

    public function actionProductAddToBasket($id)
    {
        $user_id = Yii::$app->user->identity->id;
        $basket = Basket::findOne(['user_id' => $user_id]);
        if (!isset($basket->user_id)) {
            $basket = new Basket();
        }

        $myproducts = [];
        $myproducts = json_decode($basket->products);
        $myproducts[] = $id;
        $myproducts = array_unique($myproducts);

        $basket->user_id = $user_id;
        $basket->products = json_encode($myproducts);
        Yii::$app->response->format = Response::FORMAT_JSON;
        if ($basket->save()) {
            return 'Товар добавлен в корзину';
            // echo json_encode('Товар добавлен в корзину');
            // return Yii::$app->session->addFlash('success', 'Товар добавлен в корзину');
        } else {
            return 'Ошибка';
            // Yii::$app->session->addFlash('error', 'Ошибка');
        }
    }
}
