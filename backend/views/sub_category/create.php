<?php
/* @var $this yii\web\View */

use common\models\Category;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;

$form = ActiveForm::begin([
    'options' => [
        'encrype' => 'multipart/form-data'
    ]
]);
?>

<div class="row">
    <?php
    $head_page = 'Добавить подкатегорию';
    if ($model->name) $head_page = 'Изменить подкатегорию';
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

        echo $form->field($model, 'category_id')->widget(Select2::classname(), [
            // die(var_dump($model)),
            'data' => ArrayHelper::map(Category::find()->all(), 'id', 'name'),
            'options' => ['placeholder' => 'Выберите категорию ...'],
            'pluginOptions' => [
                'allowClear' => true
            ],
        ]);
        ?>

        <div class="form-group">
            <?= Html::submitButton('Сохранить', ['class' => 'btn btn-primary']) ?>
        </div>

        <?php
        ActiveForm::end();
        ?>
    </div>
</div>