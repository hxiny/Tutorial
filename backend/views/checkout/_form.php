<?php

use app\models\DropListHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\Url;
use kartik\datetime\DateTimePicker;

/* @var $this yii\web\View */
/* @var $model app\models\House */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="bill-form">

    <?php $form = ActiveForm::begin(); $projects = DropListHelper::pay_project_str();?>

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

    <?= $form->field($model, 'PAY_ACCOUNT')->dropDownList(DropListHelper::user_str(),  ['prompt'=>'请选择缴费人...']) ?>

    <?= $form->field($model, 'PAY_START_DATE')->widget(DateTimePicker::classname(), [ 
        'options' => ['placeholder' => ''], 
        'pluginOptions' => [ 
            'autoclose' => true, 
            'todayHighlight' => true, 
        ] 
    ]) ?> 
    <?= $form->field($model, 'PAY_END_DATE')->widget(DateTimePicker::classname(), [ 
        'options' => ['placeholder' => ''], 
        'pluginOptions' => [ 
            'autoclose' => true, 
            'todayHighlight' => true, 
        ] 
    ]) ?> 
<label class="control-label" for="payproject-project_id">缴费项目</label>
<?php if(isset($payProjectsArr) && !empty($payProjectsArr)) :$count=0;?>
<?php foreach($payProjectsArr as $pid => $pam):$count++;?>
     <div class="form-group project-block">
         <div class="col-sm-4">
            <select class="form-control" name="PayProject[PROJECT_ID][]">
                <option>请选择缴费项目...</option>
<?php foreach ($projects as $key=>$value) {
    if ($key == $pid) {
        echo "<option value='{$key}' selected='selected'>{$value}</option>";
    } else {
        echo "<option value='{$key}'>{$value}</option>";
    }
}?>
            </select>
         </div>
         <div class="col-sm-4">
         <input value="<?=$pam?>" type="text" class="form-control" name="PayProject[PAY_AMOUNT][]" placeholder="请输入金额">
         </div>
         <div class="col-sm-4">
<?php if($count == 1):?>
            <a class="btn btn-primary" id="add-project">+</a>
<?php else:?>
            <a class="btn btn-danger" class="delete-project">-</a>
<?php endif;?>
         </div>
     </div>
<?php endforeach;?>
<?php else:?>
     <div class="form-group project-block">
         <div class="col-sm-4">
            <select class="form-control" name="PayProject[PROJECT_ID][]">
                <option>请选择缴费项目...</option>
<?php foreach ($projects as $key=>$value) {
    echo "<option value='{$key}'>{$value}</option>";
}?>
            </select>
         </div>
         <div class="col-sm-4">
            <input type="text" class="form-control" name="PayProject[PAY_AMOUNT][]" placeholder="请输入金额">
         </div>
         <div class="col-sm-4">
            <a class="btn btn-primary" id="add-project">+</a>
         </div>
     </div>

<?php endif;?>
<p class="clearfix"></p>
    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? '新增' : '更新', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>
</div>
<?php
    $options = '<option>请选择缴费项目...</option>';
    foreach ($projects as $key => $value) {
        $options .= '<option value=\"' .$key .'\">' . $value . '</option>';
    }
    
    $this->registerJs('
        $("#add-project").on("click", function(){
            var projectHtml = ""; 
            projectHtml += "<div class=\"form-group\">";
            projectHtml += " <div class=\"col-sm-4\">";
            projectHtml += " <select class=\"form-control\" name=\"PayProject[PROJECT_ID][]\">";
            projectHtml += " ' .$options .'";
            projectHtml += " </select>";
            projectHtml += " </div>";
            projectHtml += " <div class=\"col-sm-4\">";
            projectHtml += " <input type=\"text\" name=\"PayProject[PAY_AMOUNT][]\" class=\"form-control\" placeholder=\"请输入金额\">";
            projectHtml += " </div>";
            projectHtml += " <div class=\"col-sm-4\">";
            projectHtml += " <a class=\"btn btn-danger delete-project\">-</a>";
            projectHtml += " </div>";
            projectHtml += " </div>";
            $(".project-block").append(projectHtml);
       });
        $(".form-group").on("click", ".delete-project", function(){
            $(this).closest(".form-group").remove();
        });
        //小区改变
        $("#cells-cell_id").change(function() {
            var cellid = $(this).val();
            $("#build-build_id").html("<option value=\"0\">请选择所属楼宇...</option>");
            $("#ownerbill-house_id").html("<option value=\"0\">请选择所属房屋...</option>");
            if (cellid > 0) {
                getBuilds(cellid);
            }
        });
        $("#build-build_id").change(function() {
            var buildid = $(this).val();
            $("#ownerbill-house_id").html("<option value=\"\">请选择所属房屋...</option>");
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
                        $("#ownerbill-house_id").append(appendOp);
                     }
                 }
            });
        }
    ');

?>
