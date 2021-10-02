<?php

use common\models\User;
use kartik\select2\Select2;
?>

<?=
$form->field($model, 'status')->widget(Select2::classname(), [
    'data' => [
        User::STATUS_DELETED => 'Удалённый',
        User::STATUS_INACTIVE => 'Не активный',
        User::STATUS_ACTIVE => 'Активный',
    ],
    'size' => Select2::SMALL,
    'options' => ['placeholder' => 'Выберите ...', 'multiple' => false],
    'pluginOptions' => [
        'allowClear' => true,
    ],
]);
?>
