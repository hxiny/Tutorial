<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\TRepairWorkNotes */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="trepair-work-notes-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'ID')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'NOTES_ID')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'PRE_REPAIR_TIME')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'REAL_REPAIR_TIME')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'REPAIR_FEE')->textInput() ?>

    <?= $form->field($model, 'REPAIR_SCHEMA_DIRECT')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'SEND_USER')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'REPAIR_USER')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'REPAIR_USER_PHONE')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'CREATE_TIME')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'OPER_TIME')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'OPER_USER')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'REMARK')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? '添加' : '更新', ['class' => $model->isNewRecord ? 'btn 
        btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
