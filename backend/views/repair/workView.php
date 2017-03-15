<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\TRepairWorkNotes */

$this->title = $model->ID;
$this->params['breadcrumbs'][] = ['label' => 'Trepair Work Notes', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="trepair-work-notes-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('更新', ['work-update', 'id' => $model->ID], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('删除', ['work-delete', 'id' => $model->ID], [
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
            'NOTES_ID',
            'PRE_REPAIR_TIME',
            'REAL_REPAIR_TIME',
            'REPAIR_FEE',
            'REPAIR_SCHEMA_DIRECT',
            'SEND_USER',
            'REPAIR_USER',
            'REPAIR_USER_PHONE',
            'CREATE_TIME',
            'OPER_TIME',
            'OPER_USER',
            'REMARK',
        ],
    ]) ?>

</div>
