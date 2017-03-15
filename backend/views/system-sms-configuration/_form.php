<?php

use app\models\DropListHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model app\models\systemSmsConfiguration */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="system-sms-configuration-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'company_id')->dropDownList(DropListHelper::company_str(), ['prompt' => '请选择公司...'])?>

    <?= $form->field($model, 'app_id')->dropDownList(isset($appidArray) ? $appidArray : array(), ['prompt' => '请选择公众号...'])?>

    <?= $form->field($model, 'configuration_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'app_key')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'secret_key')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'extend')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'sms_type')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'sms_free_sign_name')->textInput(['maxlength' => true]) ?> 

    <?= $form->field($model, 'sms_template_code')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'type')->radioList(['1' => '短信通知', '2' => '验证码']) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? '新增' : '更新', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

<?php
    
    $this->registerJs('
        
        //公司改变
        $("#systemsmsconfiguration-company_id").change(function() {
            var companyid = $(this).val();
            $("#systemsmsconfiguration-app_id").html("<option value=\"\">请选择公众号...</option>");
            if (companyid > 0) {
                getApp(companyid);
            }
        });

        function getApp(id)
        {
            var href = "' . Url::to(['/location/appid'], true). '";
            $.ajax({
                "type" : "GET",
                 "url"  : href,
                 "data" : {companyId : id},
                 "dataType": "JSON",
                 success : function(d) {
                     if(d){
                        var appendOp = "";
                        $.each(d, function(index, value, array) {
                            appendOp += "<option value=\"" + index + "\">" + value + "</option>";
                        });
                        $("#systemsmsconfiguration-app_id").append(appendOp);
                     }
                 }
            });
        }

    ');


?>
