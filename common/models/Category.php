<?php

namespace common\models;

use yii\db\ActiveRecord;

/**
 * @property int $id
 * @property string $name
 * @property string $description
 */
class Category extends ActiveRecord
{
    public static function tableName()
    {
        return 'categories';
    }
    public function rules()
    {
        return [];
    }
    public function attributeLabels()
    {
        return [
            'name' => 'Название категории',
            'description' => 'Описание категории',
        ];
    }

    // // описываем связь с другой таблицей
    // // связь/класс с которой соединяем/по каким полям связываем
    // /**
    //  * @return \yii\db\ActiveQuery
    //  */
    // public function getSub_categories()
    // {
    //     return $this->hasMany(Sub_category::className(), ['category_id' => 'id']);
    // }
}
