<?php

use app\models\DropListHelper;
use dosamigos\datepicker\DatePicker;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Cells */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="cells-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'PROPERTY_ID')->dropDownList(DropListHelper::company_str(),  ['prompt'=>'请选择所属公司...']) ?>

    <?= $form->field($model, 'NAME')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'TYPE')->dropDownList(DropListHelper::cell_type_str(),  ['prompt'=>'请选择小区类型...']) ?>

    <?= $form->field($model, 'ADDRESS')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'START_WORK_DATE')->widget(
        DatePicker::className(), [
        'language' => 'zh-CN',
        'clientOptions' => [
            'autoclose' => true,
            'format' => 'yyyy-m-dd'
        ]
    ]);?>

    <?= $form->field($model, 'COMPLE_WORK_DATE')->widget(
        DatePicker::className(), [
        'language' => 'zh-CN',
        'clientOptions' => [
            'autoclose' => true,
            'format' => 'yyyy-m-dd'
        ]
    ]);?>

    <?= $form->field($model, 'STAGE')->textInput() ?>

    <?= $form->field($model, 'TOTAL_HOUSE')->textInput() ?>

    <?= $form->field($model, 'TOTAL_BUILD')->textInput() ?>

    <?= $form->field($model, 'BUILD_AREA')->textInput() ?>

    <?= $form->field($model, 'COVER_AREA')->textInput() ?>

    <?= $form->field($model, 'HOUSE_AREA')->textInput() ?>

    <?= $form->field($model, 'STORE_AREA')->textInput() ?>

    <?= $form->field($model, 'OFFICE_AREA')->textInput() ?>

    <?= $form->field($model, 'CLUB_AREA')->textInput() ?>

    <?= $form->field($model, 'GREEN_AREA')->textInput() ?>

    <?= $form->field($model, 'PACK_NUM')->textInput() ?>

    <?= $form->field($model, 'ENTER_NUM')->textInput() ?>

    <?= $form->field($model, 'EXIT_NUM')->textInput() ?>

    <?= $form->field($model, 'LONGITUDE')->textInput() ?>

    <?= $form->field($model, 'LATITUDE')->textInput() ?>

    <?= $form->field($model, 'PLANE')->textInput() ?>

    <?= $form->field($model, 'REMARK')->textInput(['maxlength' => true]) ?>



    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? '新增' : '更新', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
