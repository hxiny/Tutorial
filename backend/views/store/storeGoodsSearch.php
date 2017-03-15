<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\TStoreGoodsSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="tstore-goods-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'ID') ?>

    <?= $form->field($model, 'STORE_ID') ?>

    <?= $form->field($model, 'GOODS_NAME') ?>

    <?= $form->field($model, 'GOODS_PRICE') ?>

    <?= $form->field($model, 'STATUS') ?>

    <?php // echo $form->field($model, 'REMARK') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
