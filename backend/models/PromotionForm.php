<?php

namespace backend\models;

use yii\base\Model;
use yii\web\UploadedFile;

class PromotionForm extends Model
{
    public $name;
    public $description;
    public $imageFile;

    public function rules()
    {
        return [
            // название поля, тип, сообщение при ошибке
            // можно использовать свою функцию, 'func_name'
            [['name', 'description'], 'string', 'message' => 'не верный тип'],
            [['name', 'description'], 'required', 'message' => 'значение обязательное'],
            [['imageFile'], 'file', 'skipOnEmpty' => false, 'extensions' => 'png, jpg', 'message' => 'необходимо загрузить файл'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'name' => 'Название акции',
            'description' => 'Описание акции',
            'imageFile' => 'Картинка акции',
        ];
    }
    public function upload()
    {
        if ($this->validate('name, description')) {
            $url_image = $this->imagePath();
            $this->imageFile->saveAs($url_image);
            return $url_image;
        }
        return false;
    }
    public function imagePath()
    {
        if (!file_exists('../../uploads/')) mkdir('../../uploads/');

        return '../../uploads/' . md5(microtime() . rand(0, 10000))  . '.' . $this->imageFile->extension;
    }
}
