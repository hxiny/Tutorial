<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\UserAuth */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="user-auth-form">

    <?php $form = ActiveForm::begin(); ?>

<!--    --><?//= $form->field($model, 'ID')->textInput(['maxlength' => true]) ?>
<!---->
<!--    --><?//= $form->field($model, 'AUTH_USER')->textInput(['maxlength' => true]) ?>
<!---->
<!--    --><?//= $form->field($model, 'CELL_ID')->textInput(['maxlength' => true]) ?>
<!---->
<!--    --><?//= $form->field($model, 'USER_NAME')->textInput(['maxlength' => true]) ?>
<!---->
<!--    --><?//= $form->field($model, 'CERT_ID')->textInput(['maxlength' => true]) ?>
<!---->
<!--    --><?//= $form->field($model, 'CERT_IMG')->textarea(['rows' => 6]) ?>

<!--    --><?//= $form->field($model, 'AUTH_FLOW')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'AUTH_STATUS')->textInput(['maxlength' => true]) ?>

<!--    --><?//= $form->field($model, 'AUTH_LIMIT')->textInput(['maxlength' => true]) ?>
<!---->
<!--    --><?//= $form->field($model, 'REMARK')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
