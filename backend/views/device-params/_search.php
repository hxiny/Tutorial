<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\DeviceParamsSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="device-params-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'ID') ?>

    <?= $form->field($model, 'APP_ID') ?>

    <?= $form->field($model, 'GID') ?>

    <?= $form->field($model, 'AGT_NUM') ?>

    <?= $form->field($model, 'MD_BINDINGS_URL') ?>

    <?php // echo $form->field($model, 'MD_OPENDOOR_URL') ?>

    <?php // echo $form->field($model, 'MD_SHARE_URL') ?>

    <?php // echo $form->field($model, 'APP_KEY') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
