<?php

use app\models\DropListHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\TStoreGoods */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="tstore-goods-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'STORE_ID')->dropDownList(DropListHelper::store_str(),  ['prompt'=>'请选择商家...']) ?>

    <?= $form->field($model, 'GOODS_NAME')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'GOODS_PRICE')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'STATUS')->dropDownList(DropListHelper::goods_status_arr()) ?>

    <?= $form->field($model, 'REMARK')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? '添加' : '更新', ['class' => $model->isNewRecord ? 'btn 
        btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
