<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\CellsSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="cells-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'ID') ?>

    <?= $form->field($model, 'PROPERTY_ID') ?>

    <?= $form->field($model, 'NAME') ?>

    <?= $form->field($model, 'TYPE') ?>

    <?= $form->field($model, 'ADDRESS') ?>

    <?php // echo $form->field($model, 'START_WORK_DATE') ?>

    <?php // echo $form->field($model, 'COMPLE_WORK_DATE') ?>

    <?php // echo $form->field($model, 'STAGE') ?>

    <?php // echo $form->field($model, 'TOTAL_HOUSE') ?>

    <?php // echo $form->field($model, 'TOTAL_BUILD') ?>

    <?php // echo $form->field($model, 'BUILD_AREA') ?>

    <?php // echo $form->field($model, 'COVER_AREA') ?>

    <?php // echo $form->field($model, 'HOUSE_AREA') ?>

    <?php // echo $form->field($model, 'STORE_AREA') ?>

    <?php // echo $form->field($model, 'OFFICE_AREA') ?>

    <?php // echo $form->field($model, 'CLUB_AREA') ?>

    <?php // echo $form->field($model, 'GREEN_AREA') ?>

    <?php // echo $form->field($model, 'PACK_NUM') ?>

    <?php // echo $form->field($model, 'ENTER_NUM') ?>

    <?php // echo $form->field($model, 'EXIT_NUM') ?>

    <?php // echo $form->field($model, 'LONGITUDE') ?>

    <?php // echo $form->field($model, 'PLANE') ?>

    <?php // echo $form->field($model, 'CREATE_TIME') ?>

    <?php // echo $form->field($model, 'UPDATE_TIME') ?>

    <?php // echo $form->field($model, 'CREATE_USER') ?>

    <?php // echo $form->field($model, 'UPDATE_USER') ?>

    <?php // echo $form->field($model, 'REMARK') ?>

    <?php // echo $form->field($model, 'LATITUDE') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
