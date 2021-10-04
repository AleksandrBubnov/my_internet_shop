<?php
/* @var $this yii\web\View */

use yii\grid\GridView;
use yii\helpers\Html;
use yii\helpers\Url;

?>

<div class="row">
    <div class="col-md-12">
        <?=
        Html::a(
            'ДОБАВИТЬ ПОДКАТЕГОРИЮ',
            Url::toRoute('/sub_category/create'),
            [
                'class' => 'btn btn-success pull-right mb-1',
                'id' => 'sub_category-create'
            ]
        );
        ?>
    </div>
</div>

<div class="row">
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
                [
                    'label' => 'Категория',
                    'attribute' => 'category',
                    // 'attribute' => 'category.name',
                ],
                [
                    'class' => 'yii\grid\ActionColumn',
                    'header' => 'Действия',
                    'options' => [
                        'style' => 'width: 20%;',
                    ],
                    'template' => '{view} {update} {delete}',
                    'buttons' => [
                        'view' => function ($url, $model, $key) {
                            return Html::a('Показать', [
                                'view',
                                'id' => $model['id']
                            ], [
                                'class' => 'btn btn-primary'
                            ]);
                        },
                        'update' => function ($url, $model, $key) {
                            return Html::a('Изменить', [
                                'update',
                                'id' => $model['id']
                            ], [
                                'class' => 'btn btn-success'
                            ]);
                        },
                        'delete' => function ($url, $model, $key) {
                            return Html::a('Удалить', [
                                'delete',
                                'id' => $model['id']
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
</div>