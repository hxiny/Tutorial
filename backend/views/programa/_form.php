<?php

use app\models\DropListHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Programa */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="programa-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'cell_id')->dropDownList(DropListHelper::auth_cell_str(), ['prompt'=>'请选择小区...']) ?>

    <?= $form->field($model, 'programa_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'programa_type')->dropDownList(['1' => '文章栏目', '2'=>'功能栏目'], ['prompt' => '请选择栏目类型...']) ?>

    <?= $form->field($model, 'order')->textInput() ?>

    <?= $form->field($model, 'is_show')->radioList(['1'=>'是', '0'=>'否']) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? '新增' : '更新', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
