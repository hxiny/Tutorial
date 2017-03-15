<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\BuildSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="build-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'ID') ?>

    <?= $form->field($model, 'CELL_ID') ?>

    <?= $form->field($model, 'AREA_ID') ?>

    <?= $form->field($model, 'BUILD_NUM') ?>

    <?= $form->field($model, 'ADDRESS') ?>

    <?php // echo $form->field($model, 'STOREY_NUM') ?>

    <?php // echo $form->field($model, 'IS_ACCESS') ?>

    <?php // echo $form->field($model, 'ELEVATOR_NUM') ?>

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
