<?php

use yii\grid\GridView;


?>

<div class="row">
    <div class="col-md-12">
        <?=
        GridView::widget([
            'dataProvider' => $dataProvider,
            'columns' => [
                ['class' => 'yii\grid\SerialColumn'],
                [
                    'label' => 'Фамилия',
                    'attribute' => 'user.last_name',
                ],
                [
                    'label' => 'Имя',
                    'attribute' => 'user.username',
                ],
                [
                    'label' => 'Дата доставки',
                    'attribute' => 'date_delivery',
                ],
                [
                    'label' => 'Адрес доставки',
                    'attribute' => 'address',
                ],
                [
                    'label' => 'Номер телефона',
                    'attribute' => 'phone',
                ],
            ],
        ]);
        ?>

    </div>
</div>