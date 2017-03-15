<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\TStoreTypeSearchaaa */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="trepair-notes-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'ID') ?>

    <?= $form->field($model, 'USER_ID') ?>

    <?= $form->field($model, 'REPAIR_TIME') ?>

    <?= $form->field($model, 'REPAIR_PROJECT') ?>

    <?= $form->field($model, 'REPAIR_PROBLEM') ?>

    <?php // echo $form->field($model, 'REPAIR_CONTENT') ?>

    <?php // echo $form->field($model, 'REPAIR_TYPE') ?>

    <?php // echo $form->field($model, 'REPAIR_IMG') ?>

    <?php // echo $form->field($model, 'CELL_ID') ?>

    <?php // echo $form->field($model, 'BUILD_NUM') ?>

    <?php // echo $form->field($model, 'HOUSE_CODE') ?>

    <?php // echo $form->field($model, 'PHONE') ?>

    <?php // echo $form->field($model, 'EXPECT_TIME') ?>

    <?php // echo $form->field($model, 'STATUS') ?>

    <?php // echo $form->field($model, 'CREATE_TIME') ?>

    <?php // echo $form->field($model, 'CREATE_USER') ?>

    <?php // echo $form->field($model, 'UPDATE_TIME') ?>

    <?php // echo $form->field($model, 'UPDATE_USER') ?>

    <?php // echo $form->field($model, 'REMARK') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
