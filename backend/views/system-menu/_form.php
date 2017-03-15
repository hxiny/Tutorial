<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\SystemMenu */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="system-menu-form">
    <?php $options = ['1'=>'海星小区', '5'=>'永隆国际小区']; ?>

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'ID')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'MODULE_NAME')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'MODULE_URL')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'PIC_NAME')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'CELL_ID')->checkboxList($cells,$options)->label('小区') ?>

    <?= $form->field($model, 'SORT')->textInput() ?>

    <?= $form->field($model, 'REMARK')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? '新增' : '更新', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
