<?php

namespace common\models;

use yii\db\ActiveRecord;

/**
 * @property int $id
 * @property string $date_delivery
 * @property string $address
 * @property string $phone
 * @property string $status
 * @property int $user_id
 */
class Order extends ActiveRecord
{
    public static function tableName()
    {
        return 'orders';
    }
    public function rules()
    {
        return [];
    }
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }
}
