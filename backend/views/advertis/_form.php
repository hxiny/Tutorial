<?php

use app\models\DropListHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\datetime\DateTimePicker;

/* @var $this yii\web\View */
/* @var $model app\models\Advertis */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="advertis-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'CELL_ID')->dropDownList(DropListHelper::auth_cell_str(), ['prompt' => '请选择小区...'])->label('小区') ?>
    
    <?= $form->field($model, 'ADVERTIS_TYPE')->dropDownList(['1' => '商家广告', '2' => '文章广告', '3' => '房屋广告'], ['prompt' => '请选择广告类型...']) ?>

    <?= $form->field($model, 'ADVERTIS_TITLE')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'PIC_IMG')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'ADVERTIS_URL')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'ADVERTIS_INTRODUCT')->textarea(['rows' => 5]) ?>

    <?= $form->field($model, 'ADVERTIS_START_DATE')->widget(DateTimePicker::classname(), [ 
        'options' => ['placeholder' => ''], 
        'pluginOptions' => [ 
            'autoclose' => true,
            'todayHighlight' => true, 
            'format' => 'yyyy-mm-dd HH:ii:ss', 
        ] 
    ]) ?> 

    <?= $form->field($model, 'ADVERTIS_END_DATE')->widget(DateTimePicker::classname(), [ 
        'options' => ['placeholder' => ''], 
        'pluginOptions' => [ 
            'autoclose' => true,
            'todayHighlight' => true, 
            'format' => 'yyyy-mm-dd HH:ii:ss', 
        ] 
    ]) ?> 

    <?= $form->field($model, 'STATUS')->radioList(['1' => '是', '0' => '否']) ?>

    <?= $form->field($model, 'REMARK')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? '新增' : '更新', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
