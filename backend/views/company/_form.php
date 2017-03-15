<?php

use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\datetime\DateTimePicker;


/* @var $this yii\web\View */
/* @var $model app\models\CompanyInfo */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="company-info-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'NAME')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'ADDRESS')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'SET_DATE')->widget(DateTimePicker::classname(),\app\models\Utils::datetimeOptions() )?>

    <?= $form->field($model, 'CHARGE_MAN')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'CORPORATE')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'CREDIT_CODE')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'ENTERPRISE_TYPE')->dropDownList(ArrayHelper::map($companyList, 'CODE', 'NAME'),  ['prompt'=>'请选择企业类型...']) ?>

    <?= $form->field($model, 'ORGANIZATION_CODE')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'REMARK')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? '添加' : '更新', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
