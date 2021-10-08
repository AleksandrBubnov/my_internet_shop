<?php

namespace common\models;

use yii\db\ActiveRecord;

/**
 * @property int $id
 * @property int $product_id
 * @property int $order_id
 */
class Item extends ActiveRecord
{
    public static function tableName()
    {
        return 'items';
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
    public function getProduct()
    {
        return $this->hasOne(Product::className(), ['id' => 'product_id']);
    }
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOrder()
    {
        return $this->hasOne(Order::className(), ['id' => 'order_id']);
    }
}
