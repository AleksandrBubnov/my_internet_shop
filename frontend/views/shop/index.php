<?php

use yii\bootstrap4\Carousel;
use yii\helpers\Html;
use yii\helpers\Url;

// $products = json_encode($products);
// var_dump($products);
// var_dump($promotions);
// $js = <<<JS
//     var products=$products;
//     console.log(products[0].name);
// JS;
// $this->registerJs($js);

// var_dump($images_array);

// echo Yii::$app->user->id;
// echo Yii::getAlias('@app');


?>

<!-- <i class="bi bi-alarm"></i> -->

<?php if ($promotions) {
    $promotions_length = count($promotions);
    $active = 'active';
?>
    <!-- <div id="carouselExampleControls" class="carousel slide carousel-fade" data-ride="carousel"> -->
    <div class="row p-0 m-1">
        <div id="carouselExampleControls" class="carousel slide col-md-10 col-12" data-ride="carousel">
            <div class="carousel-inner">
                <?php for ($i = 0; $i < $promotions_length; $i++) {
                    if ($i != 0) $active = '';
                ?>

                    <div class="carousel-item <?= $active ?> ">
                        <?= Html::a(
                            Html::img(
                                Url::to($promotions[$i]->url_image),
                                [
                                    'alt' => $promotions[$i]->name,
                                    'class' => 'd-block w-100',
                                    'style' => 'max-height: 25rem',
                                ]
                            ),
                            [
                                'promotion_view',
                                'id' => $promotions[$i]->id
                            ],
                        ) ?>
                        <!-- <img src="<?= $promotions[$i]->url_image ?>" class="d-block w-100 " alt="<?= $promotions[$i]->name ?>"> -->
                        <!-- <div class="carousel-caption d-none d-md-block"> -->
                        <div class="carousel-caption ">
                            <h5><?= $promotions[$i]->name ?></h5>
                            <!-- <p><?= $promotions[$i]->name ?></p> -->
                            <?=
                            Html::a('Показать', [
                                'promotion_view',
                                'id' => $promotions[$i]->id
                            ], [
                                'class' => 'btn btn-outline-info btn-sm btn-block',
                            ]);
                            ?>
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
    </div>
<?php } ?>

<?php if ($products) {
    $products_length = count($products);
?>

    <div class="row ">
        <?php for ($j = 0; $j < $products_length; $j++) {

            $url_image = '';
            $url_images_tmp = json_decode($products[$j]->url_images);
            // die(var_dump($products));
            if ($url_images_tmp) {
                $url_image = $url_images_tmp[0];
            }
        ?>

            <div class="card col-1 p-0 m-1" style="min-width: 10rem;">
                <?= Html::a(

                    Html::img(Url::to($url_image), [
                        'alt' => $products[$j]->name,
                        'class' => 'card-img-top',
                    ]) . Html::tag(
                        'div',
                        Html::tag(
                            'h5',
                            $products[$j]->name,
                            ['class' => 'card-title text-center']
                        ),
                        [
                            'class' => ['card-body p-1'],
                        ]
                    ),
                    [
                        'view',
                        'id' => $products[$j]->id,
                    ],
                ) ?>
            </div>

        <?php } ?>
    </div>
<?php } ?>

<!-- <div class="card col-1 p-0 m-1" style="min-width: 10rem;">
    <div class="card-header">
        card-header
    </div>
    <img src="/" class="card-img-top" alt="card-img">
    <div class="card-body p-1">
        <h5 class="card-title text-center">card-title</h5>
        <h6 class="card-subtitle mb-2 text-muted">Подзаголовок карточки</h6>
        <p class="card-text">Несколько быстрых примеров текста для построения на основе заголовка карточек и составляющих основную часть содержимого карточки.</p>
        <a href="#" class="btn btn-primary">Идти куда-нибудь</a>
    </div>
    <div class="card-footer text-muted">
        card-footer
    </div>
</div> -->