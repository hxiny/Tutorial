<?php

use app\models\DropListHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\datetime\DateTimePicker;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model app\models\DeviceUserAuth */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="device-user-auth-form">

    <?php $form = ActiveForm::begin(); ?>

        <div class="form-group ">
            <label class="control-label" >用户名称</label>
            <div><?php echo $nickName?></div>
            <div class="help-block"></div>
        </div>

    <?= $form->field($model, 'VALIDITY')->widget(DateTimePicker::classname(), [ 
        'options' => ['placeholder' => ''], 
        'pluginOptions' => [
            'minView' => 'month',
            'autoclose' => true,
            'todayHighlight' => true,
            'format' => 'yyyymmdd', 
        ] 
    ]) ?> 

    <?= $form->field($model, 'KEY_TYPE')->radioList(['0'=>'业主','1'=>'访客']); ?>

    <?= $form->field($model, 'IS_BINDINGS_WECHAT')->radioList(['0'=>'否','1'=>'是']); ?>

    <?= $form->field($model, 'IS_BINDINGS_MD')->radioList(['0'=>'否','1'=>'是']); ?>

    <!-- <?= $form->field($model, 'LOCK_ID')->textInput(['maxlength' => true]) ?> -->


    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? '新增' : '更新', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>