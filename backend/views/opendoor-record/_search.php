<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\OpendoorRecordSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="opendoor-record-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'ID') ?>

    <?= $form->field($model, 'USER_ID') ?>

    <?= $form->field($model, 'CELL_ID') ?>

    <?= $form->field($model, 'DEVICE_ID') ?>

    <?= $form->field($model, 'OPEN_TIME') ?>

    <?php // echo $form->field($model, 'OPEN_RESULT') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
