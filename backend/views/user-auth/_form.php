<?php

use yii\helpers\Html;
//use yii\widgets\ActiveForm;
use yii\bootstrap\ActiveForm;
/* @var $this yii\web\View */
/* @var $model app\models\UserAuth */
///* @var $form yii\widgets\ActiveForm */
?>

<div class="user-auth-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'AUTH_STATUS')->inline()->radioList(['3'=>'不通过','2'=>'通过']); ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? '新增' : '提交', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
