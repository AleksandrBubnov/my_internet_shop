<?php

use yii\grid\GridView;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;

?>
<?php $form = ActiveForm::begin(); ?>

<div class="row">
    <div class="col-md-12">

        <table class="table table-striped table-hover table-bordered table-dark">
            <thead class="thead-dark">
                <tr>
                    <th scope="col">#</th>
                    <th scope="col" class="w-25">Название</th>
                    <th scope="col" class="w-25">Описание</th>
                    <!-- <th scope="col" class="w-25">Количество</th> -->
                    <!-- <th scope="col" class="w-25">Цена</th> -->
                    <th scope="col" class="w-25">Действия</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $index = 1;
                if ($products) {
                    foreach ($products as $product) {
                ?>
                        <tr>
                            <th scope="row"><?= $index ?></th>
                            <td> <?= $product->name ?> </td>
                            <td> <?= $product->description ?> </td>
                            <!-- <td>
                                <?= $form->field($product, 'count')->textInput([
                                    'id' => 'product_count',
                                    'type' => 'number',
                                    'min' => '0',
                                    'value' => '1',
                                    'max' => $product->count,
                                    'step' => '1',
                                ])->label(''); ?>
                                <?= $product->count ?>
                                <input type="number" class="form-control" id="product_count" aria-describedby="emailHelp">
                            </td> -->
                            <!-- <td> <?= $product->price ?> </td> -->
                            <td>
                                <?=
                                Html::a('Удалить', [
                                    'delete',
                                    'id' => $product->id
                                ], [
                                    'class' => 'btn btn-danger'
                                ]);

                                ?>
                            </td>
                        </tr>
                <?php
                        $index++;
                    }
                }
                ?>
            </tbody>
        </table>

    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <?= Html::a(
            'Оформить заказ',
            Url::toRoute(['checkout']),
            [
                'class' => 'btn btn-primary pull-right mb-1',
            ]
        ) ?>
    </div>
</div>

<?php ActiveForm::end(); ?>