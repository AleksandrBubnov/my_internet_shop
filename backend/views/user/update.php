<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

$this->title = 'Обновление пользователя';

$this->params['breadcrumbs'][] = ['label' => 'Персонал', 'url' => ['/user/index']];
$this->params['breadcrumbs'][] = $this->title;

// хеадок
$js = <<<JS
    $('#userform-status').change(function(){
        alert('Вы изменили статус пользователя');
    })
JS;

$this->registerJs($js);

$this->registerCss("
    #div_test {
        background-color: yellow;
    }
");

?>

<div class="panel panel-default">
    <div class="panel-heading" id="div_test"><?= $this->title ?></div>
    <div class="panel-body">

        <?php
        $form = ActiveForm::begin();
        ?>

        <div class="row">
            <div class="col-md-6">
                <?= $form->field($model, 'email')->textInput(['readonly' => 'readonly']); ?>
            </div>
            <div class="col-md-6">
                <?= $form->field($model, 'username')->textInput(['readonly' => true]); ?>
            </div>
        </div>

        <div class="row">
            <div class="col-md-4">
                <?= $form->field($model, 'last_name')->textInput(); ?>
            </div>
            <div class="col-md-4">
                <?= $form->field($model, 'first_name')->textInput(); ?>
            </div>
            <div class="col-md-4">
                <?= $form->field($model, 'second_name')->textInput(); ?>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6">
                <?= $this->render('_part/_roles', [
                    'form' => $form,
                    'model' => $model,
                    'roles_array' => $roles_array,
                ]); ?>
            </div>
            <div class="col-md-6">
                <?= $this->render('_part/_status', [
                    'form' => $form,
                    'model' => $model,
                ]); ?>
            </div>
        </div>

        <div class="form-group">
            <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>
        </div>

        <?php
        ActiveForm::end();
        ?>

    </div>
</div>