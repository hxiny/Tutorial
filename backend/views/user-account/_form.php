<?php

use app\models\DropListHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\UserAccount */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="user-account-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'ID')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'USER_ID')->dropDownList(DropListHelper::user_str(), ['prompt'=>'请选择用户...']) ?>

    <?= $form->field($model, 'ACCOUNT_TYPE')->dropDownList(['0' => 0, '1' => '1', '2' => '2'], ['prompt' => '请选择类型...']) ?>

    <?= $form->field($model, 'ACCOUNT_OVER')->textInput() ?>

    <?= $form->field($model, 'ACCOUNT_INTEGRAL')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? '新增' : '更新', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
