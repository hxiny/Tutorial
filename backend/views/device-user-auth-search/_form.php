<?php

use app\models\DropListHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\datetime\DateTimePicker;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model app\models\DeviceUserAuth */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="device-user-auth-form">

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

    <?= $form->field($model, 'USER_ID')->checkboxList([]) ?>
    <div id="user_ids_sel_box" style="display: none;">
        <span class="btn btn-primary btn-xs" id="user_id_selectall" >全选</span>
        <span class="btn btn-primary btn-xs" id="user_id_selectall_no" >取消全选</span>
    </div>

    <?= $form->field($model, 'DEVICE_NAME')->checkboxList([]) ?>
    <div id="devices_name_sel_box" style="display: none;">
        <span class="btn btn-primary btn-xs" id="device_names_selectall" >全选</span>
        <span class="btn btn-primary btn-xs" id="device_names_selectall_no" >取消全选</span>
    </div>

<!--     <?= $form->field($model, 'AUID')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'USER_ID')->textInput(['maxlength' => true]) ?> -->

    <?= $form->field($model, 'VALIDITY')->widget(DateTimePicker::classname(), [ 
        'options' => ['placeholder' => ''], 
        'pluginOptions' => [ 
            'autoclose' => true,
            'minView' => 'month',
            'todayHighlight' => true, 
            'format' => 'yyyymmdd', 
        ] 
    ]) ?> 

    <?= $form->field($model, 'KEY_TYPE')->radioList(['0'=>'业主','1'=>'访客']); ?>

    <?= $form->field($model, 'IS_BINDINGS_WECHAT')->radioList(['0'=>'否','1'=>'是']); ?>

    <?= $form->field($model, 'IS_BINDINGS_MD')->radioList(['0'=>'否','1'=>'是']); ?>

    <!-- <?= $form->field($model, 'LOCK_ID')->textInput(['maxlength' => true]) ?> -->


    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? '新增' : '更新', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

<?php
    
    $this->registerJs('
        
        //小区改变
        $("#cells-cell_id").change(function() {
            var cellid = $(this).val();
            $("#build-build_id").html("<option value=\"0\">请选择所属楼宇...</option>");
            $("#deviceuserauth-house_id").html("<option value=\"0\">请选择所属房屋...</option>");
            $("#deviceuserauth-device_name").html("");
            $("#deviceuserauth-user_id").html("");
            if (cellid > 0) {
                getBuilds(cellid);
                getDevice(cellid);
                $("#devices_name_sel_box").css("display","block");
            }
        });
        $("#build-build_id").change(function() {
            var buildid = $(this).val();
            $("#deviceuserauth-house_id").html("<option value=\"\">请选择所属房屋...</option>");
            if (buildid > 0) {
                getHouses(buildid);
            }
        });
        $("#deviceuserauth-house_id").change(function() {
            var houseid = $(this).val();
            $("#deviceuserauth-user_id").html("");
            if (houseid > 0) {
                getHouseUsers(houseid);
                $("#user_ids_sel_box").css("display","block");
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
        function getDevice(id)
        {
            var href = "' . Url::to(['/location/devices'], true). '";
            $.ajax({
                "type" : "GET",
                 "url"  : href,
                 "data" : {cellId : id},
                 "dataType": "JSON",
                 success : function(d) {
                     if(d){
                        var appendOp = "";
                        $.each(d, function(index, value, array) {
                            appendOp += "<label style=\"width:50%\"><input type=\"checkbox\" name=\"DeviceUserAuth[DEVICE_NAME][]\" value=\""+value+"\">" + value + "</label>";
                        });
                        $("#deviceuserauth-device_name").append(appendOp);
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
                        $("#deviceuserauth-house_id").append(appendOp);
                     }
                 }
            });
        }

        function getHouseUsers(id)
        {
            var href = "' . Url::to(['/location/houseusers'], true). '";
            $.ajax({
                "type" : "GET",
                 "url"  : href,
                 "data" : {houseId : id},
                 "dataType": "JSON",
                 success : function(d) {
                     if(d){
                        var appendOp = "";
                        $.each(d, function(index, value, array) {
                            appendOp += "<label style=\"width:50%\"><input type=\"checkbox\" name=\"DeviceUserAuth[USER_ID][]\" value=\""+index+"\">" + value + "</label>"
                        });
                        $("#deviceuserauth-user_id").append(appendOp);
                     }
                 }
            });
        }

        $("#device_names_selectall").click(function() {
            $("input[name=\"DeviceUserAuth[DEVICE_NAME][]\"]").each(function(){
                $(this).prop("checked",true);
            });
        });
        $("#device_names_selectall_no").click(function() {
            $("input[name=\"DeviceUserAuth[DEVICE_NAME][]\"]").each(function(){
                $(this).prop("checked",false);
            });
        });
        $("#user_id_selectall").click(function() {
            $("input[name=\"DeviceUserAuth[USER_ID][]\"]").each(function(){
                $(this).prop("checked",true);
            });
        });
        $("#user_id_selectall_no").click(function() {
            $("input[name=\"DeviceUserAuth[USER_ID][]\"]").each(function(){
                $(this).prop("checked",false);
            });
        });

    ');


?>
