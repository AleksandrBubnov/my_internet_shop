<?php

namespace backend\controllers;

use common\models\Item;
use common\models\Order;
use Yii;
use yii\data\ActiveDataProvider;
use yii\filters\AccessControl;
use yii\web\Controller;

class OrderController extends Controller
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
        // $user_id = Yii::$app->user->identity->id;
        // $dataProvider = new ActiveDataProvider([
        //     'query' => Order::find()->where(['user_id' => $user_id]),
        // ]);
        // $order = Order::find()->where(['user_id' => $user_id])->all();
        // // $item = Item::find()->where(['order_id' => $order->id])->asArray()->all();
        // return $this->render('index', [
        //     'dataProvider' => $dataProvider,
        //     'order' => $order,
        // ]);

        $dataProvider = new ActiveDataProvider([
            'query' => Order::find()
        ]);

        return $this->render('index', ['dataProvider' => $dataProvider]);
    }
}
