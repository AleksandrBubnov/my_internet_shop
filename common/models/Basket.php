<?php

namespace common\models;

use yii\db\ActiveRecord;

/**
 * @property int $id
 * @property string $products
 * @property int $user_id
 */
class Basket extends ActiveRecord
{
    public static function tableName()
    {
        return 'baskets';
    }
    public function rules()
    {
        return [];
    }
}
