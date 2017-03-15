<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\DeviceShareRecord */

$this->title = $model->ID;
$this->params['breadcrumbs'][] = ['label' => 'Device Share Records', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="device-share-record-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->ID], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->ID], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
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
            'SHARE_TIME',
            'OPEN_TIME',
            'SHARE_NAME',
            'SHARE_PHONE',
        ],
    ]) ?>

</div>
