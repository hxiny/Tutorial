<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\TRepairEvidenceSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="trepair-evidence-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'ID') ?>

    <?= $form->field($model, 'REPAIR_NOTES_ID') ?>

    <?= $form->field($model, 'WORK_NOTES_ID') ?>

    <?= $form->field($model, 'DEAL_BEFORE_PHOTO') ?>

    <?= $form->field($model, 'DEAL_AFTER_PHOTO') ?>

    <?php // echo $form->field($model, 'REMARK') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
