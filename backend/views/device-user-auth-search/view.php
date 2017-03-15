<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\DeviceUserAuth */

$this->title = $model->ID;
$this->params['breadcrumbs'][] = ['label' => '钥匙管理', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="device-user-auth-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('编辑', ['update', 'id' => $model->ID], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('删除', ['delete', 'id' => $model->ID], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => '设备删除将删除所有关联用户钥匙?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'ID',
            'DEVICE_ID',
            'DEVICE_NAME',
            'PID',
            'AUID',
            'USER_ID',
            'KEY_TYPE',
            'IS_BINDINGS_WECHAT',
            'IS_BINDINGS_MD',
            'LOCK_ID',
            'VALIDITY',
            'KSID',
            'CELL_ID',
        ],
    ]) ?>

</div>
