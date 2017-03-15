<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\datetime\DateTimePicker;

/* @var $this yii\web\View */
/* @var $model app\models\DeviceApply */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="device-apply-form">

    <?php $form = ActiveForm::begin(); ?>
    
    <?= $form->field($model, 'USER_ID')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'CELL_ID')->dropDownList(\app\models\DropListHelper::auth_cell_str()) ?>

    <?= $form->field($model, 'DEVICE_ID')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'VALIDITY')->widget(DateTimePicker::classname(), [ 
        'options' => ['placeholder' => ''], 
        'pluginOptions' => [
            'minView' => 'month',
            'autoclose' => true,
            'todayHighlight' => true,
            'format' => 'yyyymmdd', 
        ] 
    ]) ?> 

    <?= $form->field($model, 'APPLY_TIME')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'AUDIT_STATUS')->radioList(['0'=>'否','1'=>'是']); ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
