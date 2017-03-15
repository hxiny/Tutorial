<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\PayFormulaSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="pay-formula-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'formula_id') ?>

    <?= $form->field($model, 'formula_name') ?>

    <?= $form->field($model, 'formula_type') ?>

    <?= $form->field($model, 'formula_text') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
