<?php

namespace backend\models;

use yii\base\Model;

class OrderForm extends Model
{
    public $date_delivery;
    public $address;
    public $phone;
    public $status;
    public $user_id;

    public function rules()
    {
        return [
            [['date_delivery', 'address', 'phone', 'user_id'], 'string'],
            [['status'], 'integer'],
            [['date_delivery', 'address', 'user_id'], 'required'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'user_id' => 'Клиент',
            'date_delivery' => 'Дата доставки',
            'address' => 'Адрес доставки',
            'phone' => 'Номер телефона',
            'status' => 'Статус заказа',
        ];
    }
}
