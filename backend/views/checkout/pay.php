<?php

use app\models\DropListHelper;
use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\ArrayHelper;
use yii\widgets\ActiveForm;

$this->title = '收款';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="bill-form">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php $form = ActiveForm::begin(); ?>
<p>应缴合计：<?= $billModel->PAY_AMOUNT ?></p>
    <p>预存款余额抵扣：<?php echo $depositAmount > $billModel->PAY_AMOUNT ? $billModel->PAY_AMOUNT : $depositAmount;?></p>
    <p>应缴金额：<?php echo $depositAmount > $billModel->PAY_AMOUNT ? 0 : $billModel->PAY_AMOUNT - $depositAmount;?></p>

    <?= $form->field($model, 'PAY_TYPE')->dropDownList(DropListHelper::pay_type_str(),  ['prompt'=>'请选择收费方式...']) ?>

    <?= $form->field($model, 'REMARK')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('收款', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>



