<?php
/* @var $this yii\web\View */

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\file\FileInput;
use yii\helpers\Url;

// use yii\{bootstrap5}\Modal;
// use kartikorm\ActiveForm;
use kartik\date\DatePicker;

// FileInput::bsVersion = 3;

$form = ActiveForm::begin([
    'options' => [
        'encrype' => 'multipart/form-data'
    ]
]);
?>

<div class="row">
    <?php
    $head_page = 'Добавить акцию';
    if ($model->name) $head_page = 'Изменить акцию';
    ?>
    <div class="col-md-12">
        <h3><?= $head_page ?></h3>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <?php
        echo $form->field($model, 'name')->textInput();
        echo $form->field($model, 'description')->textarea(['rows' => '5']);
        ?>

        <div class="row">
            <div class="col_md-6 mr-3">
                <?= // Usage with model and Active Form (with no default initial value)
                $form->field($model, 'date_start')->widget(DatePicker::classname(), [
                    'options' => ['placeholder' => 'Enter birth date ...'],
                    'readonly' => true,
                    // 'size' => 'lg',
                    'pluginOptions' => [
                        'todayHighlight' => true,
                        'todayBtn' => true,
                        'autoclose' => true,
                        'format' => 'dd/mm/yyyy',
                    ]
                ]); ?>
            </div>
            <div class="col_md-6">
                <?=
                $form->field($model, 'date_end')->widget(DatePicker::classname(), [
                    'options' => ['placeholder' => 'Enter birth date ...'],
                    'pluginOptions' => [
                        'autoclose' => true,
                    ]
                ]); ?>
            </div>
        </div>

        <?php
        // echo $form->field($model, 'imageFile')->fileInput(
        echo $form->field($model, 'imageFile')->widget(
            FileInput::classname(),
            [
                'options' => [
                    'accept' => 'image/*',
                    'multiple' => false
                ],
                'pluginOptions' => [
                    'initialPreview' => $initial_prev,
                    'initialPreviewConfig' => $image_conf,
                    'initialPreviewAsData' => true,
                    'showCaption' => false,
                    'showRemove' => true,
                    'showUpload' => false,
                    'removeClass' => 'btn btn-default pull-right',
                    'browseClass' => 'btn btn-primary pull-right',
                    'removeLabel' => 'Удалить',
                    'browseLabel' => 'Загрузить',
                    'maxFileSize' => 2800,
                    'deleteUrl' => Url::to([
                        '/select-data/file-delete-promotion?id=' .
                            $promotion_id
                    ]),
                ]
            ]
        );
        #region
        // echo FileInput::widget([
        //     'name' => 'attachment_49[]',
        //     'options' => [
        //         'multiple' => true
        //     ],
        //     'pluginOptions' => [
        //         'initialPreview' => [
        //             "https://upload.wikimedia.org/wikipedia/commons/thumb/e/e1/FullMoon2010.jpg/631px-FullMoon2010.jpg",
        //             "https://upload.wikimedia.org/wikipedia/commons/thumb/6/6f/Earth_Eastern_Hemisphere.jpg/600px-Earth_Eastern_Hemisphere.jpg"
        //         ],
        //         'initialPreviewAsData' => true,
        //         'initialCaption' => "The Moon and the Earth",
        //         'initialPreviewConfig' => [
        //             ['caption' => 'Moon.jpg', 'size' => '873727'],
        //             ['caption' => 'Earth.jpg', 'size' => '1287883'],
        //         ],
        //         'overwriteInitial' => false,
        //         'maxFileSize' => 2800
        //     ]
        // ]);
        #endregion
        ?>
        <div class="form-group">
            <?= Html::submitButton('Сохранить', ['class' => 'btn btn-primary']) ?>
        </div>

        <?php
        ActiveForm::end();
        ?>
    </div>
</div>