<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\SmsFormulaData */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="sms-formula-data-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'variable_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'variable')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'query_table')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'query_column')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? '新增' : '删除', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
