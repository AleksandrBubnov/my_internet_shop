<?php

namespace backend\controllers;

use backend\models\CategoryForm;
use common\models\Category;
use Yii;
use yii\data\ActiveDataProvider;
use yii\filters\AccessControl;
use yii\web\Controller;

class CategoryController extends Controller
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
        $dataProvider = new ActiveDataProvider([
            'query' => Category::find()
        ]);

        return $this->render('index', ['dataProvider' => $dataProvider]);
    }

    public function actionCreate()
    {
        $model = new CategoryForm();
        if ($model->load(Yii::$app->request->post())) {
            $category = new Category();
            $category->name = $model->name;
            $category->description = $model->description;
            if ($category->save()) {
                Yii::$app->session->addFlash('success', 'Категория сохранена');
            } else {
                Yii::$app->session->addFlash('error', 'Ошибка сохранения категории');
            }
            return $this->redirect(['/category/index']);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    public function actionView($id)
    {
        $category = Category::findOne(['id' => $id]);
        if ($category) {
            return $this->render('view', [
                'category' => $category,
            ]);
        } else {
            Yii::$app->session->addFlash('error', 'Категория не найдена');
        }
    }

    public function actionUpdate($id)
    {
        $category = Category::findOne(['id' => $id]);
        $model = new CategoryForm();

        if ($model->load(Yii::$app->request->post())) {
            $category->name = $model->name;
            $category->description = $model->description;
            if ($category->save()) {
                Yii::$app->session->addFlash('success', 'Категория сохранена');
            } else {
                Yii::$app->session->addFlash('error', 'Ошибка сохранения категории');
            }
            return $this->redirect(['/category/index']);
        }

        $model->name = $category->name;
        $model->description = $category->description;

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    public function actionDelete($id)
    {
        $category = Category::findOne(['id' => $id]);
        if ($category) {
            if ($category->delete()) {
                Yii::$app->session->addFlash('success', 'Категория удалена');
            } else {
                Yii::$app->session->addFlash('error', 'Ошибка удаления категории');
            }
        } else {
            Yii::$app->session->addFlash('error', 'Категория не найдена');
        }
        return $this->redirect(['/category/index']);
    }
}
