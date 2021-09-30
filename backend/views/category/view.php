<?php
/* @var $this yii\web\View */

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;

$form = ActiveForm::begin([
    'options' => [
        'encrype' => 'multipart/form-data'
    ]
]);
// die(var_dump($category));
?>

<div class="row">
    <div class="col-md-12">
        <h3>КАТЕГОРИЯ</h3>
    </div>
</div>

<div class="row">
    <div class="col-md-12">

        <?php
        echo $form->field($category, 'name')->textInput(['readonly' => true]);
        echo $form->field($category, 'description')->textarea(['rows' => '10', 'readonly' => true]);
        ?>

    </div>
</div>

<div class="form-group">

    <?=
    Html::a(
        'Закрыть',
        Url::toRoute('/category/index'),
        [
            'class' => 'btn btn-primary float-right mb-2 ',
        ]
    );
    ?>

    <?php
    ActiveForm::end();
    ?>

</div>