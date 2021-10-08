<?php
/* @var $this yii\web\View */

use yii\helpers\Html;
use yii\helpers\Url;

$this->title = "Tовар: $product->name";

// $form = ActiveForm::begin([
//     'options' => [
//         'encrype' => 'multipart/form-data',
//     ],
// ]);
?>
<?php $url_images_length = count($url_images);
$active = 'active';
?>

<div class="row col-md-12 p-0 m-0 mb-3">

    <div id="carouselExampleControls" class="carousel slide carousel-fade col-md-4 col-12 bg-light mr-2 p-0" data-interval="false">
        <div class="carousel-inner">
            <?php for ($i = 0; $i < $url_images_length; $i++) {
                if ($i != 0) $active = '';
            ?>
                <div class="carousel-item <?= $active ?> ">
                    <?=
                    Html::img(
                        Url::to($url_images[$i]),
                        [
                            'class' => 'd-block w-100',
                            'style' => 'max-height: 25rem',
                        ]
                    )
                    ?>
                    <div class="carousel-caption d-none">
                        <h5><?= $product->name ?></h5>
                        <p><?= $product->name ?></p>
                    </div>
                </div>
            <?php } ?>
        </div>
        <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Предыдущий</span>
        </a>
        <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Следующий</span>
        </a>
    </div>

    <div class="col-lg col-12 p-0">
        <div class="card-body p-2 ">
            <h5 class="card-title "><?= $product->name ?></h5>
            <p class="card-text ">Цена: <?= $product->price ?> UAH</p>
            <pre class="card-text"><?= $product->description ?></pre>
        </div>
    </div>

</div>

<?php
$js = <<<JS
    $('#pushToBasket').click(function(){
        let xmlhttp = new XMLHttpRequest();
        let url = 'product-add-to-basket';
        let text = '';

        xmlhttp.open('GET', url, true);
        xmlhttp.onreadystatechange = function() {
            if (this.status == 200 && this.readyState == 4) {
                if (this.responseText) {
                    // let text = JSON.parse(this.responseText);
                    alert(this.responseText);
                }
            }
        }
        xmlhttp.send();

    })
JS;

$this->registerJs($js);
?>

<?php
// $msg = 'msg';
// Modal::begin([
//     'title' => $this->title,
//     'toggleButton' => [
//         'id' => 'pushToBasket1',
//         'label' => 'Добавить в корзину <i class="bi bi-basket2"></i>',
//         'class' => 'btn btn-outline-primary mb-2 ',
//     ],
// ]);

// echo $msg;
// Modal::end();
?>


<div class="form-group">

    <?= Html::button(
        'Добавить в корзину <i class="bi bi-basket2"></i>',
        [
            'id' => 'pushToBasket',
            'class' => 'btn btn-outline-primary float-right mb-2 ',
        ],
    ); ?>

</div>

<?php // ActiveForm::end(); 
?>