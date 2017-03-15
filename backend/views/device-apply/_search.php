<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\DeviceApplySearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="device-apply-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'ID') ?>

    <?= $form->field($model, 'USER_ID') ?>

    <?= $form->field($model, 'CELL_ID') ?>

    <?= $form->field($model, 'DEVICE_ID') ?>

    <?= $form->field($model, 'VALIDITY') ?>

    <?= $form->field($model, 'APPLY_TIME') ?>

    <?php // echo $form->field($model, 'AUDIT_STATUS') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
