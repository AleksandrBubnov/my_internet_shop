<?php

namespace backend\controllers;

use backend\models\CategoryForm;
use backend\models\Sub_categoryForm;
use common\models\Category;
use common\models\Sub_category;
use Yii;
use yii\data\ActiveDataProvider;
use yii\db\Query;
use yii\filters\AccessControl;
use yii\web\Controller;

class Sub_categoryController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'actions' => ['login', 'error'],
                        'allow' => true,
                    ],
                    [
                        // 'actions' => ['*'],
                        'allow' => true,
                        // 'roles' => ['@'],
                        'roles' => ['admin', 'owner', 'seo_manager', 'content_manager'],
                    ],
                ],
            ],
        ];
    }

    public function actionIndex()
    {
        $query = new Query();
        $query
            ->select([
                'sub_categories.id as id',
                'sub_categories.name as name',
                'sub_categories.description as description',
                'categories.name AS category'
            ])
            ->from(['sub_categories'])
            ->join('LEFT JOIN', 'categories', 'categories.id = category_id');

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionCreate()
    {
        $model = new Sub_categoryForm();
        if ($model->load(Yii::$app->request->post())) {
            $sub_category = new Sub_category();
            $sub_category->name = $model->name;
            $sub_category->description = $model->description;
            $sub_category->category_id = $model->category_id;
            if ($sub_category->save()) {
                Yii::$app->session->addFlash('success', 'Подкатегория сохранена');
            } else {
                Yii::$app->session->addFlash('error', 'Ошибка сохранения подкатегории');
            }
            return $this->redirect(['/sub_category/index']);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    public function actionView($id)
    {
        $sub_category = Sub_category::findOne(['id' => $id]);
        $category = Category::findOne(['id' => $sub_category->category_id]);
        if (!$category) $category = new CategoryForm();

        if ($sub_category) {
            return $this->render('view', [
                'category' => $category,
                'sub_category' => $sub_category
            ]);
        } else {
            Yii::$app->session->addFlash('error', 'Подкатегория не найдена');
        }
    }

    public function actionUpdate($id)
    {
        $sub_category = Sub_category::findOne(['id' => $id]);
        $category = Category::findOne(['id' => $sub_category->category_id]);
        if (!$category) $category = new CategoryForm();
        $model = new Sub_categoryForm();

        if ($model->load(Yii::$app->request->post())) {
            $sub_category->name = $model->name;
            $sub_category->description = $model->description;
            $sub_category->category_id = $model->category_id;
            if ($sub_category->save()) {
                Yii::$app->session->addFlash('success', 'Подкатегория сохранена');
            } else {
                Yii::$app->session->addFlash('error', 'Ошибка сохранения подкатегории');
            }
            return $this->redirect(['/sub_category/index']);
        }

        $model->name = $sub_category->name;
        $model->description = $sub_category->description;
        $model->category_id = $sub_category->category_id;

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    public function actionDelete($id)
    {
        $sub_category = Sub_category::findOne(['id' => $id]);
        if ($sub_category) {
            if ($sub_category->delete()) {
                Yii::$app->session->addFlash('success', 'Подкатегория удалена');
            } else {
                Yii::$app->session->addFlash('error', 'Ошибка удаления подкатегории');
            }
        } else {
            Yii::$app->session->addFlash('error', 'Подкатегория не найдена');
        }
        return $this->redirect(['/sub_category/index']);
    }
}
