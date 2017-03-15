<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\TStoreType */
/* @var $storeTypeCell app\models\TStoreTypeCell */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="tstore-type-form">

    <?php $form = ActiveForm::begin(); ?>


    <?= $form->field($storeTypeCell, 'CELL_ID')->dropDownList(\app\models\DropListHelper::auth_cell_str()) ?>
    <?= $form->field($storeTypeCell, 'STATUS')->dropDownList(\app\models\DropListHelper::store_type_cell_status_dictionary_arr()) ?>

    <?= $form->field($model, 'TYPE_NAME')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'TYPE_URL')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'PIC_NAME')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'SORT')->textInput() ?>

    <?= $form->field($model, 'REMARK')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? '添加' : '更新', ['class' => $model->isNewRecord ? 'btn 
        btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
