<?php

use app\models\DropListHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\SmsFormula */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="sms-formula-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'sms_configuration_id')->dropDownList(DropListHelper::sms_configuration(), ['prompt' => '请选择短信机配置...']) ?>

    <?= $form->field($model, 'cell_id')->dropDownList(DropListHelper::auth_cell_str(), ['prompt'=>'请选择小区...']) ?>

    <?= $form->field($model, 'formula_name')->textInput() ?>

    <?= $form->field($model, 'variable_set')->checkBoxList(DropListHelper::sms_variable()) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? '新增' : '更新', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
