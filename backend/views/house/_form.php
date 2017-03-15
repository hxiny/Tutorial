<?php

use app\models\DropListHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model app\models\House */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="house-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'BUILD_ID')->dropDownList(DropListHelper::build_str(),  ['prompt'=>'请选择所属楼宇...']) ?>

    <?= $form->field($model, 'STOREY')->textInput() ?>

    <?= $form->field($model, 'HOUSE_CODE')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'HOUSE_TYPE')->dropDownList(DropListHelper::house_type_str(),  ['prompt'=>'请选择房屋类型...']) ?>

    <?= $form->field($model, 'HOUSE_AREA')->textInput() ?>

    <?= $form->field($model, 'DEVICE_ID')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'POOL_AREA')->textInput() ?>

    <?= $form->field($model, 'IS_DOUBLE_DECK')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'HOUSE_HEIGHT')->textInput() ?>

    <?= $form->field($model, 'ORIENTATION')->dropDownList(DropListHelper::orientation_str(),  ['prompt'=>'请选择房屋朝向...']) ?>

    <?= $form->field($model, 'ROOM_NUM')->textInput() ?>

    <?= $form->field($model, 'HALL_NUM')->textInput() ?>

    <?= $form->field($model, 'BALCONY_NUM')->textInput() ?>

    <?= $form->field($model, 'KITCHEN_NUM')->textInput() ?>

    <?= $form->field($model, 'BATHROOM_NUM')->textInput() ?>


    <?= $form->field($model, 'REMARK')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? '新增' : '更新', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
