<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\TStoreSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="tstore-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'ID') ?>

    <?= $form->field($model, 'NAME') ?>

    <?= $form->field($model, 'PIC_URL') ?>

    <?= $form->field($model, 'STORE_TYPE') ?>

    <?= $form->field($model, 'STORE_INTRODUCT') ?>

    <?php // echo $form->field($model, 'STORE_IMG') ?>

    <?php // echo $form->field($model, 'IS_TOP') ?>

    <?php // echo $form->field($model, 'PHONE') ?>

    <?php // echo $form->field($model, 'LANDLINE') ?>

    <?php // echo $form->field($model, 'STAR_LEVEL') ?>

    <?php // echo $form->field($model, 'AWAY_FROM') ?>

    <?php // echo $form->field($model, 'ADDRESS') ?>

    <?php // echo $form->field($model, 'BOSS_NAME') ?>

    <?php // echo $form->field($model, 'BOSS_CERT') ?>

    <?php // echo $form->field($model, 'OPEN_TIME') ?>

    <?php // echo $form->field($model, 'CERT_INFO') ?>

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
