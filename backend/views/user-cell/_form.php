<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\UserCell */
/* @var $form yii\widgets\ActiveForm */

$url=json_encode(Url::to(['/location'], true));
$this->registerJs("var url = {$url};");
$this->registerJs($this->render('_form.js'));

$userSelect = new \app\models\UserSelect();
?>

<div class="user-cell-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'USER_ID')->textInput(['readonly'=>true,
        'data-toggle' => 'modal',
        'data-target' => '.bs-example-modal-lg',
    ]) ?>

    <?php

    if (isset($model->user)) {
        $user = $model->user;
    }else{
        $user = new \app\models\User();
    }
    echo $form->field($user, 'NICKNAME')->textInput(['readonly'=>true,
        'data-toggle' => 'modal',
        'data-target' => '.bs-example-modal-lg',
    ]) ;
    echo $form->field($user, 'PHONE')->textInput(['readonly'=>true,
        'data-toggle' => 'modal',
        'data-target' => '.bs-example-modal-lg',
    ]) ;
    ?>
    <?= $form->field($model, 'HOUSE_IDENTITY')->dropDownList(\app\models\DropListHelper::identity()) ?>

    <?= $form->field($model, 'CELL_ID')->dropDownList(\app\models\DropListHelper::auth_cell_str()) ?>

    <?= $form->field($model, 'BUILD_ID')->dropDownList([],['prompt'=>'请选择所属楼宇']) ?>

    <?= $form->field($model, 'HOUSE_ID')->dropDownList([],['prompt'=>'请选择所属房屋...']) ?>

    <?= $form->field($model, 'STATUS')->dropDownList(\app\models\DropListHelper::user_cell_status_arr()) ?>
    <?= $form->field($model, 'IS_DEFAULT')->radioList(\app\models\DropListHelper::boolean_str()) ?>
    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? '添加' : '更新', ['class' => $model->isNewRecord ? 'btn 
        btn-success' : 'btn btn-primary']) ?>
    </div>
    <?php ActiveForm::end(); ?>

    <!-- Large modal -->
    <div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">
        <div class="modal-dialog modal-lg" role="document" >
            <div class="modal-content" style="height: 700px;padding: 20px;">
                <?= $form->field($userSelect, 'NAME')->textInput() ?>
                <?= $form->field($userSelect, 'PHONE')->textInput() ?>
                <div class="btn btn-success btn-assign col-lg-12" id="btn_search">搜索</div>
                <select id="user_select"  multiple size="20" class="form-control list" data-target="avaliable"
                        style="margin-top: 20px;">
                </select>
            </div>
        </div>
    </div>
</div>
