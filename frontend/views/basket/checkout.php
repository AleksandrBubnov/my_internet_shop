<?php

use yii\widgets\ActiveForm;
use yii\helpers\Html;

$this->title = 'Оформление заказа';


?>

<div class="panel panel-default">
    <div class="panel-heading">
        <h4><?= $this->title ?></h4>
    </div>
    <div class="panel-body">

        <?php $form = ActiveForm::begin(); ?>

        <div class="row">
            <div class="col-md-12">
                <?= $form->field($model, 'phone')->textInput(); ?>
            </div>
            <div class="col-md-12">
                <?= $form->field($model, 'address')->textarea(['rows' => 5]); ?>
            </div>
        </div>

        <div class="form-group">
            <?= Html::submitButton('Оформить', ['class' => 'btn btn-primary']) ?>
        </div>

    </div>
</div>
<?php ActiveForm::end(); ?>