<?php

use app\models\DropListHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\Helpers\Url;

/* @var $this yii\web\View */
/* @var $model app\models\PayTamplate */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="pay-tamplate-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'tamplate_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'cell_id')->dropDownList(DropListHelper::cell_str(),['prompt' => '请选择小区...']) ?>

    <?= $form->field($model, 'build_id')->dropDownList([''],['prompt'=>'请选择楼房...']) ?>

    <?= $form->field($model, 'accuracy')->dropDownList(['0'=>'元', '1'=>'角', '2'=>'分']) ?>

    <?= $form->field($model, 'formula_types')->checkBoxList($formulaTypes) ?>

    <?= $form->field($model, 'unit_cost')->textInput() ?>

    <?= $form->field($model, 'period')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? '新增' : '更新', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

<?php
    
    $this -> registerJs('

        $("#paytamplate-cell_id").change(function() {
            var cellId = $(this).val();
            $("#paytamplate-build_id").html("<option value=\"0\">请选择楼房...</option>");
            var href = "' . Url::to(['/location/builds'], true). '";
            $.ajax({
                "type" : "GET",
                 "url"  : href,
                 "data" : {cellId : cellId},
                 "dataType": "JSON",
                 success : function(d) {
                     if(d){
                        var appendOp = "";
                        $.each(d, function(index, value, array) {
                            appendOp += "<option value=\"" + index + "\">" + value + "</option>";
                        });
                        $("#paytamplate-build_id").append(appendOp);
                     }
                 }
            });
        })

    ')

?>
