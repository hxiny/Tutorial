<?php

use app\models\DropListHelper;
use dosamigos\datepicker\DatePicker;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model app\models\Device */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="device-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'CELL_ID')->dropDownList(DropListHelper::auth_cell_str(),  ['prompt'=>'请选择小区...']) ?>

    <!-- <?= $form->field($model, 'DEVICE_ID')->textInput(['maxlength' => true]) ?> -->

    <?= $form->field($model, 'DEVICE_NAME')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'SERIAL_NUMBER')->textInput(['maxlength' => true]) ?>

    <?=$form->field($model, 'provinces')->dropDownList(ArrayHelper::map(app\models\Region::find()->where(['father_id'=>0])->asArray()->all(),'region_code','region_name'),
        [
        'prompt'=>'请选择省',
        'onchange'=>'
            $.post("'.Url::to('/location/citys').'?id='.'"+$(this).val(),function(data){             
                 $("#device-citys").html("<option value=>请选择市</option>");
                 $("#device-countys").html("<option value=>请选择县</option>");
                 $("#device-citys").append(data);
            });',
        ])->label('省份'); ?>
    <?=$form->field($model, 'citys')->dropDownList([''],
        [
        'prompt'=>'请选择市',
        'onchange'=>' $.post("'.Url::to(['/location/countys']).'?id='.'"+$(this).val(),function(data){
             $("#device-countys").html("<option value=>请选择县</option>");
             $("#device-countys").append(data);
        });',
        ])->label('市'); ?>

     <?=$form->field($model, 'countys')->dropDownList([''],
        [
        // 'style'=>'width:150px',
        'prompt'=>'请选择县',
        ])->label('区/县'); ?>     

    <?= $form->field($model, 'REMARK')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? '新增设备' : '修改设备', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
