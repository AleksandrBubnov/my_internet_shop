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
$pro_date = '';
if ($promotion->date_start && $promotion->date_end) {
    $pro_date = $promotion->date_start . ' - ' . $promotion->date_end;
}
?>

<div class="row">
    <div class="col-md-12">
        <h3>АКЦИЯ</h3>
    </div>
</div>

<div class="row col-md-12 p-0 m-0 mb-3">
    <div class="col-md-4 col-12 bg-light card mr-2 p-0">
        <img class="card-img" src="<?= '../../' . $promotion->url_image ?>" alt="<?= $promotion->url_image ?>">

    </div>

    <div class="col-lg col-12 p-0">
        <div class="card-body p-2 ">
            <h5 class="card-title "><?= $promotion->name ?></h5>
            <p class="card-text "><?= $pro_date ?></p>
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
        Url::toRoute('/shop/index'),
        [
            'class' => 'btn btn-primary float-right mb-2 ',
        ]
    );
    ?>

    <?php
    ActiveForm::end();
    ?>

</div>