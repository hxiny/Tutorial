<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\CompanyInfo */

$this->title = $model->NAME;
$this->params['breadcrumbs'][] = ['label' => '公司信息', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="company-info-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('编辑', ['update', 'id' => $model->ID], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('删除', ['delete', 'id' => $model->ID], [
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
            'ID',
            'NAME',
            'ADDRESS',
            'SET_DATE',
            'CHARGE_MAN',
            'CORPORATE',
            'CREDIT_CODE',
            'ENTERPRISE_TYPE',
            'ORGANIZATION_CODE',
            'CREATE_TIME',
            'UPDATE_TIME',
            'CREATE_USER',
            'UPDATE_USER',
            'REMARK',
        ],
    ]) ?>

</div>
