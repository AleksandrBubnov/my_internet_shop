<?php

namespace backend\controllers;

use common\models\Promotion;
use Yii;
use yii\web\Controller;
use yii\web\Response;

class SelectDataController extends Controller
{
    public function actionFileDeletePromotion($id)
    {
        Yii::$app->response->format = Response::FORMAT_JSON;
        if (isset($_POST['key'])) {
            $name_file = '../../uploads' . $_POST['key'];
            if (file_exists($name_file)) unlink($name_file);
            $promotion = Promotion::findOne(['id' => $id]);
            $promotion->url_image = null;
            $promotion->save();
        }
        return true;
    }
}
