<?php

namespace common\models;

use yii\db\ActiveRecord;

/**
 * @property int $id
 * @property string $name
 * @property string $description
 * @property int $count
 * @property float $price
 * @property int $category_id
 * @property int $sub_category_id
 * @property string $url_images
 */
class Product extends ActiveRecord
{
    public static function tableName()
    {
        return 'products';
    }
    public function rules()
    {
        return [];
    }
    // описываем связь с другой таблицей
    // связь/класс с которой соединяем/по каким полям связываем
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCategory()
    {
        return $this->hasOne(Category::className(), ['id' => 'category_id']);
    }
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSub_category()
    {
        return $this->hasOne(Sub_category::className(), ['id' => 'sub_category_id']);
    }
}
