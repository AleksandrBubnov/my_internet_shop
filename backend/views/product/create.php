<?php

use yii\widgets\ActiveForm;
use kartik\select2\Select2;
use kartik\depdrop\DepDrop;
use yii\helpers\Html;
use yii\helpers\Url;
use kartik\file\FileInput;

$this->title = 'Добавить товар';
if ($model->name) $this->title = 'Изменить товар';

$this->params['breadcrumbs'][] = ['label' => 'Продукты', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

if ($model->sub_category_id) $init = true;
else $init = false;
?>

<div class="panel panel-default">
    <div class="panel-heading">
        <h4><?= $this->title ?></h4>
    </div>
    <div class="panel-body">

        <?php
        $form = ActiveForm::begin();
        ?>

        <div class="row">
            <div class="col-md-12">
                <?= $form->field($model, 'name')->textInput()->label('Название товара'); ?>
            </div>
            <div class="col-md-12">
                <?= $form->field($model, 'description')->textarea(['rows' => 5]); ?>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <?=
                $form->field($model, 'category_id')->widget(Select2::classname(), [
                    'data' => $categories_array,
                    'options' => [
                        'placeholder' => 'Выберите ...',
                        'multiple' => false,
                        'id' => 'category',
                    ],
                    'pluginOptions' => [
                        'allowClear' => true,
                    ],
                ]);
                ?>
            </div>
            <div class="col-md-6">
                <?= Html::hiddenInput('sel-sub_category', $model->category_id, ['id' => 'sel-sub_category']); ?>
                <?=
                $form->field($model, 'sub_category_id')->widget(DepDrop::classname(), [
                    'type' => DepDrop::TYPE_SELECT2,
                    'data' => [],
                    'options' => [
                        'placeholder' => 'Начните вводить название подкатегории ...',
                        'multiple' => false,
                        'id' => 'sub_category',
                    ],
                    'select2Options' => [
                        'pluginOptions' => [
                            'allowClear' => true
                        ]
                    ],
                    'pluginOptions' => [
                        'depends' => ['category'],
                        'initialize' => $init,
                        'url' => Url::to(['/select-data/sub_category']),
                        'params' => ['category', 'sel-sub_category'],
                        'loadingText' => 'Ожидайте загрузки',
                    ]
                ]);
                ?>

            </div>
        </div>

        <div class="row">
            <div class="col-md-6">
                <?= $form->field($model, 'count')->textInput([
                    'type' => 'number',
                    'min' => '0',
                    'step' => '1',
                ])->label('Количество товара'); ?>
            </div>
            <div class="col-md-6">
                <?= $form->field($model, 'price')->textInput([
                    'type' => 'number',
                    'min' => '0',
                    'step' => '0.01',
                ])->label('Цена товара'); ?>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <?php
                // echo $form->field($model, 'imageFile')->fileInput(
                echo $form->field($model, 'images')->widget(
                    FileInput::classname(),
                    [
                        'options' => [
                            'accept' => 'image/*',
                            'multiple' => true,
                            'max' => 10,
                        ],
                        'pluginOptions' => [
                            'initialPreview' => $initial_prev,
                            'initialPreviewConfig' => $image_conf,
                            'initialPreviewAsData' => true,
                            'showCaption' => false,
                            // 'showRemove' => true,
                            'showUpload' => false,
                            'removeClass' => 'btn btn-default pull-right',
                            'browseClass' => 'btn btn-primary pull-right',
                            'removeLabel' => 'Удалить',
                            'browseLabel' => 'Загрузить',
                            'maxFileSize' => 2800,
                        ]
                    ]
                );

                ?>
            </div>
        </div>

        <div class="form-group">
            <?= Html::submitButton('Сохранить', ['class' => 'btn btn-primary']) ?>
        </div>

        <?php
        ActiveForm::end();
        ?>
    </div>
</div>