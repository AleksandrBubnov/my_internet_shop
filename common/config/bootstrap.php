<?php
Yii::setAlias('@common', dirname(__DIR__));
Yii::setAlias('@frontend', dirname(dirname(__DIR__)) . '/frontend');
Yii::setAlias('@backend', dirname(dirname(__DIR__)) . '/backend');
Yii::setAlias('@console', dirname(dirname(__DIR__)) . '/console');
Yii::setAlias('@service', dirname(dirname(__DIR__)) . '/service');

Yii::setAlias('@uploads', dirname(dirname(__DIR__)) . '\uploads');
// Yii::setAlias('@uploads2', realpath(dirname(__FILE__) . '/../../uploads'));
