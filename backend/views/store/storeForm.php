<?php

use app\models\DropListHelper;
use kartik\datetime\DateTimePicker;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\TStore */
/* @var $form yii\widgets\ActiveForm */

?>

<div class="tstore-form">

    <?php $form = ActiveForm::begin(["options" => ["enctype" => "multipart/form-data"]]); ?>

    <?= $form->field($cell, 'ID')->label('小区')->dropDownList(DropListHelper::cell_str(),  ['prompt'=>'请选择小区...']) ?>

    <?= $form->field($model, 'NAME')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'PIC_URL')->fileInput() ?>

    <?= $form->field($model, 'STORE_TYPE')->dropDownList(DropListHelper::store_type_tr(),  ['prompt'=>'请选择分类...']) ?>

    <?= $form->field($model, 'STORE_INTRODUCT')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'STORE_IMG')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'IS_TOP')->radioList(\app\models\Radios::$YES_NO) ?>
    
    <?= $form->field($model, 'PHONE')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'LANDLINE')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'STAR_LEVEL')->radioList(\app\models\Radios::$STAR) ?>

    <?= $form->field($model, 'AWAY_FROM')->textInput() ?>

    <?= $form->field($model, 'ADDRESS')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'BOSS_NAME')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'BOSS_CERT')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'OPEN_TIME')->widget(DateTimePicker::classname(),\app\models\Utils::datetimeOptions() )?>

    <?= $form->field($model, 'CERT_INFO')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'REMARK')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? '添加' : '更新', ['class' => $model->isNewRecord ? 'btn 
        btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
