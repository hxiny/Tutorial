<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\OwnerBill */

$this->title = $model->BILL_ID;
$this->params['breadcrumbs'][] = ['label' => '收银台', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="build-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('编辑', ['update', 'id' => $model->BILL_ID], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('删除', ['delete', 'id' => $model->BILL_ID], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => '是否删除?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'BILL_ID',
            'HOUSE_ID',
            'PAY_AMOUNT',
            'PAY_START_DATE',
            'PAY_END_DATE',
            'PAY_STATUS',
            'CREATE_TIME',
            'PAY_USER',
            'OPER_TIME',
            'PAY_ACCOUNT',
            'REMAKR',
            'STATUS',
        ],
    ]) ?>

</div>

