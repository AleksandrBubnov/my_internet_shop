<?php
/* @var $this yii\web\View */

use yii\grid\GridView;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\helpers\Url;

?>

<div class="col-md-12">
    <?=
    GridView::widget([
        'dataProvider' => $user,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            [
                'label' => 'Ник',
                'attribute' => 'username',
            ],
            [
                'label' => 'Фамилия',
                'attribute' => 'last_name',
            ],
            [
                'label' => 'Имя',
                'attribute' => 'first_name',
            ],
            [
                'label' => 'Отчество',
                'attribute' => 'second_name',
            ],
            [
                'label' => 'Электронная почта',
                'attribute' => 'email',
            ],
            [
                'label' => 'Роль',
                'format' => 'html',
                'value' => function ($model) {
                    $auth = Yii::$app->authManager;
                    $roles = $auth->getRolesByUser(ArrayHelper::getValue($model, 'id', false));
                    $result = '';
                    foreach ($roles as $key => $value) {
                        switch ($key) {
                            case 'admin':
                                $result .= 'администратор' . '<br/>';
                                break;
                            case 'owner':
                                $result .= 'владелец' . '<br/>';
                                break;
                            case 'user':
                                $result .= 'пользователь' . '<br/>';
                                break;
                            case 'content_manager':
                                $result .= 'контент менеджер' . '<br/>';
                                break;
                            case 'seo_manager':
                                $result .= 'сео менеджер' . '<br/>';
                                break;
                            default:
                                $result .= $key . '<br/>';
                                break;
                        }
                    }
                    return $result;
                },
            ],
            [
                'label' => 'Статус',
                'value' => function ($model) {
                    switch (ArrayHelper::getValue($model, 'status', null)) {
                        case 0:
                            return 'удалён';
                        case 9:
                            return 'не активный';
                        case 10:
                            return 'активный';
                        default:
                            return ArrayHelper::getValue($model, 'status', null);
                    }
                },
            ],
            [
                'class' => 'yii\grid\ActionColumn',
                'header' => 'Действия',
                'template' => '{update} {delete}',
                'buttons' => [
                    'update' => function ($url, $model, $key) {
                        return Html::a('Изменить', [
                            'update',
                            'id' => ArrayHelper::getValue($model, 'id'),
                        ], [
                            'class' => 'btn btn-success'
                        ]);
                    },
                    'delete' => function ($url, $model, $key) {
                        if (ArrayHelper::getValue($model, 'status') != 0) {
                            return Html::a('Удалить', [
                                'delete',
                                'id' => $model['id'],
                            ], [
                                'class' => 'btn btn-danger'
                            ]);
                        } else {
                            return Html::a('Востановить', [
                                'recovery',
                                'id' => $model['id'],
                            ], [
                                'class' => 'btn btn-primary'
                            ]);
                        }
                    },
                ]
            ],
        ]
    ]);

    ?>
</div>