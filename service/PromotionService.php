<?php

namespace service;

use common\models\Promotion;

class PromotionService
{
    public function saveDB($model, $url_image)
    {
        if ($model->id) {
            $promotion = Promotion::findOne(['id' => $model->id]);
            if ($url_image != $promotion->url_image) {
                if (file_exists($promotion->url_image)) unlink($promotion->url_image);
            }
        } else {
            $promotion = new Promotion();
        }

        $promotion->name = $model->name;
        $promotion->description = $model->description;
        $promotion->url_image = $url_image;
        return $promotion->save();
    }
}
