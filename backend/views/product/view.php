<?php
/* @var $this yii\web\View */

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;
use kartik\file\FileInput;

$this->title = "Tовар: $product->name";

$this->params['breadcrumbs'][] = ['label' => 'Продукты', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

$form = ActiveForm::begin([
    'options' => [
        'encrype' => 'multipart/form-data'
    ]
]);

?>

<div class="row">
    <div class="col-md-12">

        <?php

        echo $form->field($product, 'url_images')->widget(
            FileInput::classname(),
            [
                'disabled' => true,
                'options' => [
                    'multiple' => true,
                ],
                'pluginOptions' => [
                    'initialPreview' => $url_images,
                    'initialPreviewAsData' => true,
                    'showCaption' => false,
                    'browseClass' => 'btn btn-primary pull-right',
                    'browseLabel' => 'Загрузить',
                    'maxFileSize' => 2800,
                ]
            ]
        )->label('Изображения товара');

        ?>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <?php
        echo $form->field($product, 'name')->textInput(['readonly' => true]);
        echo $form->field($product, 'description')->textarea(['rows' => '5', 'readonly' => true]);
        ?>

    </div>
</div>

<div class="form-group">
    <?=
    Html::a(
        'Закрыть',
        Url::toRoute('/product/index'),
        [
            'class' => 'btn btn-primary float-right mb-2 ',
        ]
    );
    ?>

    <?php
    ActiveForm::end();
    ?>

</div>