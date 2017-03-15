<?php

use kartik\datetime\DateTimePicker;
use kartik\file\FileInput;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\TRepairNotes */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="trepair-notes-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'USER_ID')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'REPAIR_TIME')->widget(DateTimePicker::classname(), \app\models\Utils::datetimeOptions())?>

    <?= $form->field($model, 'REPAIR_PROJECT')->dropDownList(\app\models\DropListHelper::repair_project_arr()) ?>

    <?= $form->field($model, 'REPAIR_PROBLEM')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'REPAIR_CONTENT')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'REPAIR_TYPE')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'REPAIR_IMG')->textInput(['maxlength' => true]) ?>
    <?=
//    $form->field($model, 'REPAIR_IMG')->label('报修图片')->widget(FileInput::classname(), [
//        'options' => ['multiple' => true],
//        'pluginOptions' => [
//            // 需要预览的文件格式
//            'previewFileType' => 'image',
//            // 预览的文件
//            'initialPreview' => ['图片1', '图片2', '图片3'],
//            // 需要展示的图片设置，比如图片的宽度等
//            'initialPreviewConfig' => ['width' => '120px'],
//            // 是否展示预览图
//            'initialPreviewAsData' => true,
//            // 异步上传的接口地址设置
//            'uploadUrl' => Url::toRoute(['/upload']),
//            // 异步上传需要携带的其他参数，比如商品id等
//            'uploadExtraData' => [
////                'goods_id' => $id,
//            ],
//            'uploadAsync' => true,
//            // 最少上传的文件个数限制
//            'minFileCount' => 1,
//            // 最多上传的文件个数限制
//            'maxFileCount' => 10,
//            // 是否显示移除按钮，指input上面的移除按钮，非具体图片上的移除按钮
//            'showRemove' => true,
//            // 是否显示上传按钮，指input上面的上传按钮，非具体图片上的上传按钮
//            'showUpload' => true,
//            //是否显示[选择]按钮,指input上面的[选择]按钮,非具体图片上的上传按钮
//            'showBrowse' => true,
//            // 展示图片区域是否可点击选择多文件
//            'browseOnZoneClick' => true,
//            // 如果要设置具体图片上的移除、上传和展示按钮，需要设置该选项
//            'fileActionSettings' => [
//                // 设置具体图片的查看属性为false,默认为true
//                'showZoom' => false,
//                // 设置具体图片的上传属性为true,默认为true
//                'showUpload' => true,
//                // 设置具体图片的移除属性为true,默认为true
//                'showRemove' => true,
//            ],
//        ],
//        // 一些事件行为
//        'pluginEvents' => [
//            // 上传成功后的回调方法，需要的可查看data后再做具体操作，一般不需要设置
//            "fileuploaded" => "function (event, data, id, index) {
//            console.log(data);
//        }",
//        ],
//    ]);
    ""?>
    <?= $form->field($model, 'CELL_ID')->dropDownList(\app\models\DropListHelper::auth_cell_str()) ?>

    <?= $form->field($model, 'BUILD_NUM')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'HOUSE_CODE')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'PHONE')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'EXPECT_TIME')->widget(DateTimePicker::classname(), \app\models\Utils::datetimeOptions()) ?>

    <?= $form->field($model, 'STATUS')->dropDownList(\app\models\DropListHelper::repair_notes_status_arr()) ?>

    <?= $form->field($model, 'REMARK')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? '添加' : '更新', ['class' => $model->isNewRecord ? 'btn 
        btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
