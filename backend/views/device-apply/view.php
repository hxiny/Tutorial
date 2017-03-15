<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\DeviceApply */

$this->title = $model->ID;
$this->params['breadcrumbs'][] = ['label' => '钥匙审核', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="device-apply-view">

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
            'USER_ID',
            'CELL_ID',
            'DEVICE_ID',
            'APPLY_TIME',
            'AUDIT_STATUS',
        ],
    ]) ?>

</div>
