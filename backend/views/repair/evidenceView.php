<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\TRepairEvidence */

$this->title = $model->ID;
$this->params['breadcrumbs'][] = ['label' => 'Trepair Evidences', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="trepair-evidence-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('更新', ['evidence-update', 'id' => $model->ID], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('删除', ['evidence-delete', 'id' => $model->ID], [
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
            'REPAIR_NOTES_ID',
            'WORK_NOTES_ID',
            'DEAL_BEFORE_PHOTO',
            'DEAL_AFTER_PHOTO',
            'REMARK',
        ],
    ]) ?>

</div>
