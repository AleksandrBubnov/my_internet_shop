<?php

namespace frontend\controllers;

use backend\models\OrderForm;
use common\models\Basket;
use common\models\Item;
use common\models\Order;
use common\models\Product;
use Yii;
use yii\web\Controller;

class BasketController extends Controller
{
    public function actionIndex()
    {
        $user_id = Yii::$app->user->identity->id;

        $basket = Basket::findOne(['user_id' => $user_id]);
        if (isset($basket->products) && json_decode($basket->products)) {
            $products_id = json_decode($basket->products);
            $products = [];
            if ($products_id) {
                foreach ($products_id as $id) {
                    $products[] = Product::findOne(['id' => $id]);
                }
            }
            return $this->render('index', [
                'products' => $products,
            ]);
        } else {
            Yii::$app->session->addFlash('error', 'Корзина пуста');
            return $this->redirect(Yii::$app->homeUrl);
        }
    }

    public function actionDelete($id)
    {
        $user_id = Yii::$app->user->identity->id;

        $basket = Basket::findOne(['user_id' => $user_id]);
        $products_id = [];
        $products_id = json_decode($basket->products);
        // unset($products_id[array_search($id, $products_id)]);
        $products_id = array_values(array_diff($products_id, [$id]));
        $basket->products = json_encode($products_id);
        $basket->save();
        if (!json_decode($basket->products)) {
            $basket->delete();
            Yii::$app->session->addFlash('error', 'Корзина пуста');
            return $this->redirect(Yii::$app->homeUrl);
        }

        $products = [];
        if ($products_id) {
            foreach ($products_id as $id) {
                $products[] = Product::findOne(['id' => $id]);
            }
        }

        return $this->render('index', [
            'products' => $products,
        ]);
    }

    public function actionCheckout()
    {
        $user_id = Yii::$app->user->identity->id;

        $basket = Basket::findOne(['user_id' => $user_id]);
        // die(var_dump(json_decode($basket->products)));

        if (isset($basket->products) && json_decode($basket->products)) {

            $model = new OrderForm();
            if ($model->load(Yii::$app->request->post())) {
                $order = new Order();
                $order->user_id = $user_id;
                $order->address = $model->address;
                $order->phone = $model->phone;
                $order->status = 0;
                // $model->date_delivery = date('Y-m-d H:i:s a', time());
                $model->date_delivery = date('Y-m-d H:i:s', time());
                $order->date_delivery = date(
                    'Y-m-d H:i:s',
                    strtotime($model->date_delivery . ' + 7 days')
                );
                // $order->link('customer', $customer); // ! ?
                if ($order->save()) {
                    $order_id = $order->id;
                    $products_id = json_decode($basket->products);
                    foreach ($products_id as $product_id) {
                        $item = new Item();
                        $item->order_id = $order_id;
                        $item->product_id = $product_id;
                        $item->save();
                    }

                    $basket->delete();
                    Yii::$app->session->addFlash('success', 'Заказ оформлен');
                } else {
                    Yii::$app->session->addFlash('error', 'Ошибка оформления заказа');
                }
                return $this->redirect(Yii::$app->homeUrl);
            }


            return $this->render('checkout', [
                'model' => $model,
            ]);
        } else {
            Yii::$app->session->addFlash('error', 'Корзина пуста');
            return $this->redirect(Yii::$app->homeUrl);
        }
    }
}
