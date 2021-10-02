<?php

use kartik\select2\Select2;
?>

<?=
$form->field($model, 'roles')->widget(Select2::classname(), [
    'data' => $roles_array,
    'size' => Select2::LARGE,
    'options' => ['placeholder' => 'Выберите ...', 'multiple' => true],
    'pluginOptions' => [
        'allowClear' => true,
    ],
]);
?>
