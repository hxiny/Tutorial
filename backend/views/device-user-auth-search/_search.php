<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\DeviceUserAuthSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="device-user-auth-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'ID') ?>

    <?= $form->field($model, 'DEVICE_ID') ?>

    <?= $form->field($model, 'DEVICE_NAME') ?>

    <?= $form->field($model, 'AUID') ?>

    <?= $form->field($model, 'USER_ID') ?>

    <?php // echo $form->field($model, 'KEY_TYPE') ?>

    <?php // echo $form->field($model, 'IS_BINDINGS_WECHAT') ?>

    <?php // echo $form->field($model, 'IS_BINDINGS_MD') ?>

    <?php // echo $form->field($model, 'LOCK_ID') ?>

    <?php // echo $form->field($model, 'VALIDITY') ?>

    <?php // echo $form->field($model, 'KSID') ?>

    <?php // echo $form->field($model, 'CELL_ID') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
