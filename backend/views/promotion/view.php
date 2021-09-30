<?php
/* @var $this yii\web\View */

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;
use kartik\file\FileInput;

$form = ActiveForm::begin([
    'options' => [
        'encrype' => 'multipart/form-data'
    ]
]);

?>
<div class="row">
    <div class="col-md-12">
        <h3>АКЦИЯ</h3>
    </div>
</div>

<div class="row col-md-12 p-0 m-0 mb-3">
    <div class="col-md-4 col-12 bg-light card mr-2 p-0">
        <img class="card-img" src="<?= '../../' . $promotion->url_image ?>" alt="<?= $promotion->url_image ?>">

        <?php

        // echo $form->field($model, 'imageFile')->widget(
        //     FileInput::classname(),
        //     [
        //         'disabled' => true,
        //         'options' => [
        //             'accept' => 'image/*',
        //             'multiple' => false
        //         ],
        //         'pluginOptions' => [
        //             'initialPreview' => '../../' . $promotion->url_image,
        //             'initialPreviewAsData' => true,
        //             'showCaption' => false,
        //             'browseClass' => 'btn btn-primary pull-right',
        //             'maxFileSize' => 2800,
        //         ]
        //     ]
        // );

        #region
        // echo '<label class="control-label"> Select Attachment </label>';
        // echo FileInput::widget([
        //     'disabled' => true,
        //     'name' => 'attachment_30',
        //     'pluginOptions' => [
        //         'initialPreview' => '../' . $promotion->url_image,
        //         'initialPreviewAsData' => true,
        //         // 'showPreview' => false,
        //         'showCaption' => false,
        //         'showRemove' => false,
        //         'showUpload' => false,
        //         'showBrowse' => false,
        //     ],
        //     'options' => ['accept' => 'image/*']
        // ]);
        #endregion

        ?>
    </div>

    <div class="col-lg col-12 p-0">
        <div class="card-body p-2 ">
            <h5 class="card-title "><?= $promotion->name ?></h5>
            <pre class="card-text"><?= $promotion->description ?></pre>
        </div>

        <!-- <?php
                echo $form->field($promotion, 'name')->textInput(['readonly' => true]);
                echo $form->field($promotion, 'description')->textarea(['rows' => '22', 'readonly' => true]);
                ?> -->

    </div>
</div>
<div class="form-group">
    <!-- <?= Html::submitButton('Закрыть', ['class' => 'btn btn-primary float-right mb-2 ']) ?> -->

    <?=
    Html::a(
        'Закрыть',
        Url::toRoute('/promotion/index'),
        [
            'class' => 'btn btn-primary float-right mb-2 ',
        ]
    );
    ?>

    <?php
    ActiveForm::end();
    ?>

</div>