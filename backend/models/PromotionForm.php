<?php

namespace backend\models;

use yii\base\Model;
use yii\web\UploadedFile;

class PromotionForm extends Model
{
    public $id;
    public $name;
    public $description;
    public $imageFile;
    public $date_start;
    public $date_end;

    public function rules()
    {
        return [
            // название поля, тип, сообщение при ошибке
            // можно использовать свою функцию, 'func_name'
            [['id', 'name', 'description', 'date_start', 'date_end'], 'string', 'message' => 'не верный тип'],
            [['name', 'description'], 'required', 'message' => 'значение обязательное'],
            [['imageFile'], 'file', 'skipOnEmpty' => false, 'extensions' => 'png, jpg', 'message' => 'необходимо загрузить файл'],

            [['date_start'], 'required', 'when' => function ($model) {
                if (empty($model->date_end) || $model->date_end == '') {
                    return false;
                } else {
                    return true;
                }
            }, 'whenClient' => 'function(){
                return !$("#promotionform-date_end").val() == "";
            }'],
            [['date_start', 'date_end'], 'validateDate'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'name' => 'Название акции',
            'description' => 'Описание акции',
            'imageFile' => 'Картинка акции',
            'date_start' => 'Начало акции',
            'date_end' => 'Окончание акции',
        ];
    }
    public function upload()
    {
        // if ($this->validate('name, description, date_start, date_end')) {
        if ($this->validate()) {
            $url_image = $this->imagePath();
            $this->imageFile->saveAs($url_image);
            return $url_image;
        }
        return false;
    }
    public function imagePath()
    {
        if (!file_exists('../../uploads/')) mkdir('../../uploads/');
        if (!file_exists('../../uploads/promotions/')) mkdir('../../uploads/promotions/');

        return '../../uploads/promotions/' . md5(microtime() . rand(0, 10000))  . '.' . $this->imageFile->extension;
    }
    public function validateDate()
    {
        if (
            $this->date_start != "" &&
            $this->date_end != "" &&
            $this->date_start >= $this->date_end
        ) {
            $this->addError('date_start', 'Не верно введено дату');
            $this->addError('date_end', 'Не верно введено дату');
        }
    }
}
