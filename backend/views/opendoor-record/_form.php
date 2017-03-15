<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\OpendoorRecord */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="opendoor-record-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'ID')->textInput() ?>

    <?= $form->field($model, 'USER_ID')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'CELL_ID')->dropDownList(\app\models\DropListHelper::auth_cell_str())?>

    <?= $form->field($model, 'DEVICE_ID')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'OPEN_TIME')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'OPEN_RESULT')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? '新增' : '更新', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
