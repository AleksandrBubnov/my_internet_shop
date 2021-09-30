<?php

namespace backend\models;

use yii\base\Model;

class CategoryForm extends Model
{
    public $name;
    public $description;

    public function rules()
    {
        return [
            // название поля, тип, сообщение при ошибке
            // можно использовать свою функцию, 'func_name'
            [['name', 'description'], 'string', 'message' => 'не верный тип'],
            [['name', 'description'], 'required', 'message' => 'значение обязательное'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'name' => 'Название категории',
            'description' => 'Описание категории',
        ];
    }
}
