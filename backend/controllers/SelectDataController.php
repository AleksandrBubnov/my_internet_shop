<?php

namespace backend\controllers;

use common\models\Promotion;
use common\models\Sub_category;
use Yii;
use yii\web\Controller;
use yii\web\Response;

class SelectDataController extends Controller
{
    public function actionFileDeletePromotion($id)
    {
        Yii::$app->response->format = Response::FORMAT_JSON;
        // die(var_dump($_POST['caption']));
        if (isset($_POST['key'])) {
            $name_file = '../../uploads/promotions/' . $_POST['key'];
            if (file_exists($name_file)) unlink($name_file);
            $promotion = Promotion::findOne(['id' => $id]);
            $promotion->url_image = null;
            $promotion->save();
        }
        return true;
    }

    public function actionFileDeleteProduct($id)
    {
        Yii::$app->response->format = Response::FORMAT_JSON;
        die(var_dump($_POST['key']));

        if (isset($_POST['key'])) {
            $name_file = '../../uploads/products' . $_POST['key'];
            if (file_exists($name_file)) unlink($name_file);

            // получить массив
            // сформировать новый массив

            $promotion = Promotion::findOne(['id' => $id]);
            $promotion->url_image = null;
            $promotion->save();
        }
        return true;
    }

    public function actionSub_category()
    {
        Yii::$app->response->format = Response::FORMAT_JSON;
        if (isset($_POST['depdrop_all_params']['category'])) {
            $output = [];
            $selected = [];
            $category_id = $_POST['depdrop_all_params']['category'];
            $sub_categories = Sub_category::findAll(['category_id' => $category_id]);
            $select_sub_category = $_POST['depdrop_all_params']['sel-sub_category'];
            foreach ($sub_categories as $sub_category) {
                $output[] = [
                    'id' => $sub_category->id,
                    'name' => $sub_category->name,
                ];
                if ($select_sub_category == $sub_category->id) {
                    $selected = [
                        'id' => $sub_category->id,
                        'name' => $sub_category->name,
                    ];
                }
            }
            return ['output' => $output, 'selected' => $selected];
        }
    }
}
