<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\HouseSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="house-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'ID') ?>

    <?= $form->field($model, 'BUILD_ID') ?>

    <?= $form->field($model, 'STOREY') ?>

    <?= $form->field($model, 'HOUSE_CODE') ?>

    <?= $form->field($model, 'HOUSE_TYPE') ?>

    <?php // echo $form->field($model, 'HOUSE_AREA') ?>

    <?php // echo $form->field($model, 'DEVICE_ID') ?>

    <?php // echo $form->field($model, 'POOL_AREA') ?>

    <?php // echo $form->field($model, 'IS_DOUBLE_DECK') ?>

    <?php // echo $form->field($model, 'HOUSE_HEIGHT') ?>

    <?php // echo $form->field($model, 'ORIENTATION') ?>

    <?php // echo $form->field($model, 'ROOM_NUM') ?>

    <?php // echo $form->field($model, 'HALL_NUM') ?>

    <?php // echo $form->field($model, 'BALCONY_NUM') ?>

    <?php // echo $form->field($model, 'KITCHEN_NUM') ?>

    <?php // echo $form->field($model, 'BATHROOM_NUM') ?>

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
