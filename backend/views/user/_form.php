<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\User */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="user-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'USER_ID')->textInput(['maxlength' => true, 'disabled'=>true ]) ?>

    <?= $form->field($model, 'NICKNAME')->textInput(['maxlength' => true,'disabled'=>true]) ?>

    <?= $form->field($model, 'HEADIMGURL')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'STATUS')->dropDownList(['prompt' => '请选择状态...']) ?>

    <?= $form->field($model, 'PASSWORD')->passwordInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'SEX')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'PHONE')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'NEXT_KIN_PHONE')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'QQ')->textInput() ?>

    <?= $form->field($model, 'EMAIL')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'ADDR')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'WORK_UNIT')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'REMARK')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
