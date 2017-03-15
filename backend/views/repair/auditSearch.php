<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\TRepairAuditSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="trepair-audit-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'ID') ?>

    <?= $form->field($model, 'NOTES_ID') ?>

    <?= $form->field($model, 'AUDIT_TIME') ?>

    <?= $form->field($model, 'AUDIT_USER') ?>

    <?= $form->field($model, 'AUDIT_RESULT') ?>

    <?php // echo $form->field($model, 'AUDIT_OPTION') ?>

    <?php // echo $form->field($model, 'REMARK') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
