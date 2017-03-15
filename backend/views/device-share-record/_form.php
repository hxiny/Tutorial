<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\DeviceShareRecord */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="device-share-record-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'ID')->textInput() ?>

    <?= $form->field($model, 'USER_ID')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'CELL_ID')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'SHARE_TIME')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'OPEN_TIME')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'SHARE_NAME')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'SHARE_PHONE')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
