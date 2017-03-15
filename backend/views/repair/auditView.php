<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\TRepairAudit */

$this->title = $model->ID;
$this->params['breadcrumbs'][] = ['label' => 'Trepair Audits', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="trepair-audit-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('更新', ['audit-update', 'id' => $model->ID], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('删除', ['audit-delete', 'id' => $model->ID], [
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
            'AUDIT_TIME',
            'AUDIT_USER',
            'AUDIT_RESULT',
            'AUDIT_OPTION',
            'REMARK',
        ],
    ]) ?>

</div>
