<?php

namespace common\models;

/**
 * @property int $id
 * @property string $name
 * @property string $description
 * @property int $category_id
 */
class Sub_category extends \yii\db\ActiveRecord
{
    public static function tableName()
    {
        return 'sub_categories';
    }
    public function rules()
    {
        return [];
    }

    public function attributeLabels()
    {
        return [
            'name' => 'Название подкатегории',
            'description' => 'Описание подкатегории',
            'category_id' => 'Категория',
        ];
    }

    // /**
    //  * @return \yii\db\ActiveQuery
    //  */
    // public function getCategories()
    // {
    //     return $this->hasOne(Category::className(), ['id' => 'category_id']);
    // }
}
