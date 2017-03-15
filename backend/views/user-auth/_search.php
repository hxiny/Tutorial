<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\UserAuthSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="user-auth-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'ID') ?>

    <?= $form->field($model, 'AUTH_USER') ?>

    <?= $form->field($model, 'CELL_ID') ?>

    <?= $form->field($model, 'USER_NAME') ?>

    <?= $form->field($model, 'CERT_ID') ?>

    <?php // echo $form->field($model, 'CERT_IMG') ?>

    <?php // echo $form->field($model, 'AUTH_FLOW') ?>

    <?php // echo $form->field($model, 'AUTH_STATUS') ?>

    <?php // echo $form->field($model, 'AUTH_LIMIT') ?>

    <?php // echo $form->field($model, 'REMARK') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
