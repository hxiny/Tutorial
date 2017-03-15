<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\TRepairWorkNotesSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="trepair-work-notes-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'ID') ?>

    <?= $form->field($model, 'NOTES_ID') ?>

    <?= $form->field($model, 'PRE_REPAIR_TIME') ?>

    <?= $form->field($model, 'REAL_REPAIR_TIME') ?>

    <?= $form->field($model, 'REPAIR_FEE') ?>

    <?php // echo $form->field($model, 'REPAIR_SCHEMA_DIRECT') ?>

    <?php // echo $form->field($model, 'SEND_USER') ?>

    <?php // echo $form->field($model, 'REPAIR_USER') ?>

    <?php // echo $form->field($model, 'REPAIR_USER_PHONE') ?>

    <?php // echo $form->field($model, 'CREATE_TIME') ?>

    <?php // echo $form->field($model, 'OPER_TIME') ?>

    <?php // echo $form->field($model, 'OPER_USER') ?>

    <?php // echo $form->field($model, 'REMARK') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
