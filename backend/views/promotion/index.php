<?php
/* @var $this yii\web\View */

use yii\grid\GridView;
use yii\helpers\Html;
use yii\helpers\Url;

?>

<div class="col-md-12">
    <?=
    Html::a(
        'ДОБАВИТЬ АКЦИЮ',
        Url::toRoute('/promotion/create'),
        [
            'class' => 'btn btn-success pull-right',
            'id' => 'promotion-create'
        ]
    );
    ?>
</div>
<div class="col-md-12">
    <?=
    GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            [
                'label' => 'Название',
                'attribute' => 'name',
            ],
            [
                'label' => 'Описание',
                'attribute' => 'description',
            ],
            // 'name',
            // 'description',
            [
                'class' => 'yii\grid\ActionColumn',
                // 'attribute' => 'options',
                'header' => 'Действия',
                'options' => [
                    'style' => 'width: 20%;',
                    // 'align' => 'center',
                    // 'class' => 'text-center',
                    // 'class' => 'd-flex justify-self-center',
                ],
                'template' => '{view} {update} {delete}',
                'buttons' => [
                    'view' => function ($url, $model, $key) {
                        return Html::a('Показать', [
                            'view',
                            'id' => $model->id
                        ], [
                            'class' => 'btn btn-primary'
                        ]);
                    },
                    'update' => function ($url, $model, $key) {
                        return Html::a('Изменить', [
                            'update',
                            'id' => $model->id
                        ], [
                            'class' => 'btn btn-success'
                        ]);
                    },
                    'delete' => function ($url, $model, $key) {
                        return Html::a('Удалить', [
                            'delete',
                            'id' => $model->id
                        ], [
                            'class' => 'btn btn-danger'
                        ]);
                    },
                ]
            ],
        ]
    ]);

    ?>
</div>