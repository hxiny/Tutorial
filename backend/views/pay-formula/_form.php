<?php

use app\models\DropListHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\PayFormula */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="pay-formula-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'formula_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'parameters')->dropDownList(['$unitCost'=>'单价', '$coveredArea'=>'建筑面积', '$publicArea'=>'公摊面积', '$floors'=>'楼宇层数'], ['prompt' => '请选择变量...'])->label('可选变量') ?>

    <?= $form->field($model, 'symbol')->dropDownList(['+'=>'+', '-'=>'-', '*'=>'x', '/'=>'÷', '('=>'(', ')'=>')'], ['prompt' => '请选择符号...'])->label('运算符') ?>

    <?= $form->field($model, 'formula_text')->textarea(['rows' => 3,'readOnly'=>'true']) ?>

   

    <?= $form->field($model, 'formula_type')->textarea(['rows' => 1,'readOnly'=>'true', 'style'=>'display:none'])->label('') ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? '新增' : '更新', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
         <span class="btn btn-danger" id="clear_formula">清空公式</span>
    </div>

    <?php ActiveForm::end(); ?>

</div>

<?php
	$this->registerJs('
		$("#payformula-parameters").change(function() { 
			var typs = $(this).val(), formula_text = $(this).find("option:selected").text();
			$("#payformula-formula_type").append(typs);
			$("#payformula-formula_text").append(formula_text);
		})
		$("#payformula-symbol").change(function() {
			var typs = $(this).val(), formula_text = $(this).find("option:selected").text();
			$("#payformula-formula_type").append(typs);
			$("#payformula-formula_text").append(formula_text);

		})

		$("#clear_formula").click(function() {
			$("#payformula-formula_text").html("");
			$("#payformula-formula_type").html("");
		})



	');

?>
