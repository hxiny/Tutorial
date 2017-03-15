<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\TRepairAudit */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="trepair-audit-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'ID')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'NOTES_ID')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'AUDIT_TIME')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'AUDIT_USER')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'AUDIT_RESULT')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'AUDIT_OPTION')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'REMARK')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? '添加' : '更新', ['class' => $model->isNewRecord ? 'btn 
        btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
