<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\CompanyInfoSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="company-info-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'ID') ?>

    <?= $form->field($model, 'NAME') ?>

    <?= $form->field($model, 'ADDRESS') ?>

    <?= $form->field($model, 'SET_DATE') ?>

    <?= $form->field($model, 'CHARGE_MAN') ?>

    <?php // echo $form->field($model, 'CORPORATE') ?>

    <?php // echo $form->field($model, 'CREDIT_CODE') ?>

    <?php // echo $form->field($model, 'ENTERPRISE_TYPE') ?>

    <?php // echo $form->field($model, 'ORGANIZATION_CODE') ?>

    <?php // echo $form->field($model, 'CREATE_TIME') ?>

    <?php // echo $form->field($model, 'UPDATE_TIME') ?>

    <?php // echo $form->field($model, 'CREATE_USER') ?>

    <?php // echo $form->field($model, 'UPDATE_USER') ?>

    <?php // echo $form->field($model, 'REMARK') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
