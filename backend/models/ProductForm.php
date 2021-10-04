<?php

namespace backend\models;

use yii\base\Model;
use yii\web\UploadedFile;

class ProductForm extends Model
{
    public $id;
    public $name;
    public $description;
    public $count;
    public $price;
    public $category_id;
    public $sub_category_id;
    public $images;

    public function rules()
    {
        return [
            // название поля, тип, сообщение при ошибке
            // можно использовать свою функцию, 'func_name'
            [['id', 'name', 'description'], 'string',],
            [['name', 'description', 'category_id', 'sub_category_id'], 'required',],

            [['count', 'category_id', 'sub_category_id'], 'integer',],
            [['price'], 'number',],
            [['images'], 'file', 'skipOnEmpty' => false, 'extensions' => 'png, jpg', 'maxFiles' => 10],
        ];
    }

    public function attributeLabels()
    {
        return [
            'name' => 'Название товара',
            'description' => 'Описание товара',
            'count' => 'Количество товара',
            'price' => 'Цена товара',
            'images' => 'Изображения товара',
            'category_id' => 'Категория товара',
            'sub_category_id' => 'Подкатегория товара',
        ];
    }
    public function upload()
    {
        // if ($this->validate('name, description, date_start, date_end')) {
        if ($this->validate()) {
            $result = [];
            foreach ($this->images as $image) {
                $url_image = $this->imagePath($image);
                $image->saveAs($url_image);
                $result[] = $url_image;
            }
            return $result;
        }
        return false;
    }
    public function imagePath($image)
    {
        if (!file_exists('../../uploads/')) mkdir('../../uploads/');

        if (!file_exists('../../uploads/products/')) mkdir('../../uploads/products/');
        return '../../uploads/products/' . md5(microtime() . rand(0, 10000))  . '.' . $image->extension;
    }
}
