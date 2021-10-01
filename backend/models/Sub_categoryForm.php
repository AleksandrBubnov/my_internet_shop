<?php

namespace backend\models;

use yii\base\Model;

class Sub_categoryForm extends Model
{
    public $name;
    public $description;
    public $category_id;

    public function rules()
    {
        return [
            // название поля, тип, сообщение при ошибке
            // можно использовать свою функцию, 'func_name'
            [['name', 'description'], 'string', 'message' => 'не верный тип'],
            [['category_id'], 'integer', 'message' => 'не верный тип'],
            [['name', 'description', 'category_id'], 'required', 'message' => 'значение обязательное'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'name' => 'Название подкатегории',
            'description' => 'Описание подкатегории',
            'category_id' => 'Категория',
        ];
    }
}
