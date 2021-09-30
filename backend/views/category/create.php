<?php
/* @var $this yii\web\View */

use yii\helpers\Html;
use yii\widgets\ActiveForm;

$form = ActiveForm::begin([
    'options' => [
        'encrype' => 'multipart/form-data'
    ]
]);
?>

<div class="row">
    <?php
    $head_page = 'Добавить категорию';
    if ($model->name) $head_page = 'Изменить категорию';
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
        <div class="form-group">
            <?= Html::submitButton('Сохранить', ['class' => 'btn btn-primary']) ?>
        </div>

        <?php
        ActiveForm::end();
        ?>
    </div>
</div>