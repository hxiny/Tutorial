<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\TRepairEvidence */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="trepair-evidence-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'ID')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'REPAIR_NOTES_ID')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'WORK_NOTES_ID')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'DEAL_BEFORE_PHOTO')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'DEAL_AFTER_PHOTO')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'REMARK')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? '添加' : '更新', ['class' => $model->isNewRecord ? 'btn 
        btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
