<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\AdvertisSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="advertis-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'ID') ?>

    <?= $form->field($model, 'PIC_IMG') ?>

    <?= $form->field($model, 'ADVERTIS_URL') ?>

    <?= $form->field($model, 'ADVERTIS_TYPE') ?>

    <?= $form->field($model, 'ADVERTIS_INTRODUCT') ?>

    <?php // echo $form->field($model, 'ADVERTIS_TITLE') ?>

    <?php // echo $form->field($model, 'ADVERTIS_START_DATE') ?>

    <?php // echo $form->field($model, 'ADVERTIS_END_DATE') ?>

    <?php // echo $form->field($model, 'STATUS') ?>

    <?php // echo $form->field($model, 'REMARK') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
