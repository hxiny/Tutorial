<?php

use app\models\DropListHelper;
use kartik\datetime\DateTimePicker;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\WxClientInfo */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="wx-client-info-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'cell_id')->checkBoxList(DropListHelper::auth_cell_str())->label('小区') ?>

    <?= $form->field($model, 'app_id')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'gid')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'mch_id')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'key')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'ap_secret')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'create_date')->widget(DateTimePicker::classname(),\app\models\Utils::datetimeOptions() )?>

    <?= $form->field($model, 'update_date')->widget(DateTimePicker::classname(),\app\models\Utils::datetimeOptions() )?>

    <?= $form->field($model, 'status')->radioList(\app\models\Radios::$YES_NO) ?>

    <?= $form->field($model, 'describe')->textarea(['rows' => 6]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? '新增' : '修改', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
