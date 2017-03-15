<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\PayTamplateSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="pay-tamplate-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'tamplate_id') ?>

    <?= $form->field($model, 'tamplate_name') ?>

    <?= $form->field($model, 'cell_id') ?>

    <?= $form->field($model, 'build_id') ?>

    <?= $form->field($model, 'accuracy') ?>

    <?php // echo $form->field($model, 'formula_types') ?>

    <?php // echo $form->field($model, 'unit_cost') ?>

    <?php // echo $form->field($model, 'period') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
