<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\DeviceShareRecordSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="device-share-record-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'ID') ?>

    <?= $form->field($model, 'USER_ID') ?>

    <?= $form->field($model, 'CELL_ID') ?>

    <?= $form->field($model, 'SHARE_TIME') ?>

    <?= $form->field($model, 'OPEN_TIME') ?>

    <?php // echo $form->field($model, 'SHARE_NAME') ?>

    <?php // echo $form->field($model, 'SHARE_PHONE') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
