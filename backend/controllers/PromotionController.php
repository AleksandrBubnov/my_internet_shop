<?php

namespace backend\controllers;

use backend\models\PromotionForm;
use common\models\Promotion;
use Yii;
use yii\data\ActiveDataProvider;
use yii\filters\AccessControl;
use \yii\web\Controller;
use yii\web\UploadedFile;

class PromotionController extends  Controller
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
            'query' => Promotion::find()
        ]);

        // $this->layout = false; // отключить меню
        return $this->render('index', ['dataProvider' => $dataProvider]);
    }

    public function actionCreate()
    {
        $model = new PromotionForm();

        if ($model->load(Yii::$app->request->post())) {
            $model->imageFile = UploadedFile::getInstance($model, 'imageFile');
            $url_image = $model->upload();
            if ($url_image) {
                // die(var_dump($model->imageFile));
                $promotion = new Promotion();
                $promotion->name = $model->name;
                $promotion->description = $model->description;
                $promotion->url_image = $url_image;
                if ($promotion->save()) {
                    Yii::$app->session->addFlash('success', 'Акция сохранена');
                } else {
                    Yii::$app->session->addFlash('error', 'Ошибка сохранения акции');
                }
                return $this->redirect(['/promotion/index']);
            }
        }

        return $this->render('create', ['model' => $model]);
    }

    public function actionDelete($id)
    {
        $promotion = Promotion::findOne(['id' => $id]);
        if ($promotion) {
            $url_image = $promotion->url_image;
            if ($promotion->delete()) {
                unlink($url_image);
                Yii::$app->session->addFlash('success', 'Акция удалена');
            } else {
                Yii::$app->session->addFlash('error', 'Ошибка удаления акции');
            }
        } else {
            Yii::$app->session->addFlash('error', 'Акция не найдена');
        }
        return $this->redirect(['/promotion/index']);
    }

    public function actionUpdate($id)
    {
        echo 'actionUpdate';
        // return $this->render('edit');
    }

    public function actionView($id)
    {
        $promotion = Promotion::findOne(['id' => $id]);
        if ($promotion) {
            // die(var_dump($promotion));
            return $this->render('view', ['promotion' => $promotion]);
        } else {
            Yii::$app->session->addFlash('error', 'Акция не найдена');
        }
    }

    public function actionEdit()
    {
        return $this->render('edit');
    }
}
