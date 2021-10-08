<?php

namespace backend\controllers;

use backend\models\PromotionForm;
use common\models\Promotion;
use service\PromotionService;
use Yii;
use yii\data\ActiveDataProvider;
use yii\filters\AccessControl;
use \yii\web\Controller;
use yii\web\UploadedFile;

class PromotionController extends  Controller
{
    public PromotionService $promotion_service;
    public function __construct($id, $module, PromotionService $promotion_service, $config = [])
    {
        parent::__construct($id, $module, $config);
        $this->promotion_service = $promotion_service;
    }

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
                if ($this->promotion_service->saveDB($model, $url_image)) {
                    Yii::$app->session->addFlash('success', 'Акция сохранена');
                } else {
                    Yii::$app->session->addFlash('error', 'Ошибка сохранения акции');
                }
                return $this->redirect(['/promotion/index']);
            }
        }

        return $this->render('create', [
            'model' => $model,
            'initial_prev' => [],
            'image_conf' => [],
            'promotion_id' => ''
        ]);
    }

    public function actionDelete($id)
    {
        $promotion = Promotion::findOne(['id' => $id]);
        if ($promotion) {
            $url_image = $promotion->url_image;
            if ($promotion->delete()) {
                if (file_exists($url_image)) unlink($url_image);

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
        $promotion = Promotion::findOne(['id' => $id]);
        $model = new PromotionForm();
        $model->id = $id;

        if ($model->load(Yii::$app->request->post())) {
            $model->imageFile = UploadedFile::getInstance($model, 'imageFile');
            if ($url_image = $model->upload()) {
                if ($this->promotion_service->saveDB($model, $url_image)) {
                    Yii::$app->session->addFlash('success', 'Акция сохранена');
                } else {
                    Yii::$app->session->addFlash('error', 'Ошибка сохранения акции');
                }
                return $this->redirect(['/promotion/index']);
            }
        }

        $model->name = $promotion->name;
        $model->description = $promotion->description;
        $initial_prev = ['../../' . $promotion->url_image];
        $name_file = explode('/', $promotion->url_image);
        $image_conf = [
            [
                'key' => $name_file[count($name_file) - 1],
                'caption' => $name_file[count($name_file) - 1],
                'size' => '',
            ]
        ];

        return $this->render('create', [
            'model' => $model,
            'initial_prev' => $initial_prev,
            'image_conf' => $image_conf,
            'promotion_id' => $id
        ]);
    }

    public function actionView($id)
    {
        $promotion = Promotion::findOne(['id' => $id]);
        $model = new PromotionForm();
        if ($promotion) {
            $imageFile = $model->imageFile;
            // die(var_dump($promotion));
            return $this->render('view', [
                'model' => $model,
                'promotion' => $promotion
            ]);
        } else {
            Yii::$app->session->addFlash('error', 'Акция не найдена');
        }
    }
}
