<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\DeviceParams */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="device-params-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'APP_ID')->dropDownList(\app\models\DeviceParams::wxClientInfo(), ['prompt' => '请选择公众号']) ?>

    <?= $form->field($model, 'AGT_NUM')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'MD_BINDINGS_URL')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'MD_OPENDOOR_URL')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'MD_SHARE_URL')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'APP_KEY')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? '新增' : '更新', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
