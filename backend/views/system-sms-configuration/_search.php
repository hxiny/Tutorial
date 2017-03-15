<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\systemSmsConfigurationSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="system-sms-configuration-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'company_id') ?>

    <?= $form->field($model, 'app_id') ?>

    <?= $form->field($model, 'app_key') ?>

    <?= $form->field($model, 'secret_key') ?>

    <?php // echo $form->field($model, 'extend') ?>

    <?php // echo $form->field($model, 'sms_type') ?>

    <?php // echo $form->field($model, 'sms_free_sign_name') ?>

    <?php // echo $form->field($model, 'sms_template_code') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
