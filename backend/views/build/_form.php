<?php

use app\models\DropListHelper;
use dosamigos\datepicker\DatePicker;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Build */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="build-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'CELL_ID')->dropDownList(DropListHelper::auth_cell_str(),  ['prompt'=>'请选择小区...']) ?>

    <?= $form->field($model, 'AREA_ID')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'BUILD_NUM')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'ADDRESS')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'STOREY_NUM')->textInput() ?>

    <?= $form->field($model, 'IS_ACCESS')->dropDownList(DropListHelper::boolean_str(),  ['prompt'=>'请选择是否有电梯...']) ?>

    <?= $form->field($model, 'ELEVATOR_NUM')->textInput() ?>

    <?= $form->field($model, 'REMARK')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? '新增' : '更新', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
