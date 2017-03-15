<?php

use app\models\DropListHelper;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\House */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="deposit-form">

    <?php $form = ActiveForm::begin(); ?>

        <div class="form-group field-cells-cell_id">
            <label class="control-label" for="cells-cell_id">所属小区</label>
            <select id="cells-cell_id" class="form-control" name="CELLS[CELL_ID]">
            <option value="">请选择所属小区...</option>
            <?php foreach($cells as $cellId => $cellName):?>
            <option value="<?=$cellId?>"><?=$cellName?></option>
            <?php endforeach;?>
            </select>
            <div class="help-block"></div>
        </div>
        <div class="form-group field-build-build_id">
            <label class="control-label" for="build-build_id">所属楼宇</label>
            <select id="build-build_id" class="form-control" name="BUILD[BUILD_ID]">
            <option value="">请选择所属楼宇...</option>
            </select>
            <div class="help-block"></div>
        </div>
    <?= $form->field($model, 'HOUSE_ID')->dropDownList([],  ['prompt'=>'请选择所属房屋...']) ?>

    <?= $form->field($model, 'USER_ID')->dropDownList(DropListHelper::user_str(),  ['prompt'=>'请选择缴费人...']) ?>

    <?= $form->field($model, 'AMOUNT')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('保存', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

<?php
    
    $this->registerJs('
        //小区改变
        $("#cells-cell_id").change(function() {
            var cellid = $(this).val();
            $("#build-build_id").html("<option value=\"0\">请选择所属楼宇...</option>");
            $("#deposit-house_id").html("<option value=\"0\">请选择所属房屋...</option>");
            if (cellid > 0) {
                getBuilds(cellid);
            }
        });
        $("#build-build_id").change(function() {
            var buildid = $(this).val();
            $("#deposit-house_id").html("<option value=\"\">请选择所属房屋...</option>");
            if (buildid > 0) {
                getHouses(buildid);
            }
        });

        function getBuilds(id)
        {
            var href = "' . Url::to(['/location/builds'], true). '";
            $.ajax({
                "type" : "GET",
                 "url"  : href,
                 "data" : {cellId : id},
                 "dataType": "JSON",
                 success : function(d) {
                     if(d){
                        var appendOp = "";
                        $.each(d, function(index, value, array) {
                            appendOp += "<option value=\"" + index + "\">" + value + "</option>";
                        });
                        $("#build-build_id").append(appendOp);
                     }
                 }
            });
        }
        function getHouses(id)
        {
            var href = "' . Url::to(['/location/houses'], true). '";
            $.ajax({
                "type" : "GET",
                 "url"  : href,
                 "data" : {buildId : id},
                 "dataType": "JSON",
                 success : function(d) {
                     if(d){
                        var appendOp = "";
                        $.each(d, function(index, value, array) {
                            appendOp += "<option value=\"" + index + "\">" + value + "</option>";
                        });
                        $("#deposit-house_id").append(appendOp);
                     }
                 }
            });
        }
    ');

