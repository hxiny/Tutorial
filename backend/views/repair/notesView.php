<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\TRepairNotes */

$this->title = $model->REPAIR_PROBLEM;
$this->params['breadcrumbs'][] = ['label' => '报修申请单', 'url' => ['notes']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="trepair-notes-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('更新', ['notes-update', 'id' => $model->ID], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('删除', ['notes-delete', 'id' => $model->ID], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>
<!--    姓名、电话、所属小区、所属楼栋、所属房屋-->
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            [
                'label' => '姓名',
                'value'=>$model->user->NICKNAME,
            ],
            'PHONE',
            [
                'label' => '所属小区',
                'value'=>$model->cell->NAME,
            ],
            'BUILD_NUM',
            'HOUSE_CODE',
        ],
    ]) ?>
<!--    报修分类、报修内容、报修图片、	报修时间-->
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'REPAIR_TIME',
            'REPAIR_PROJECT',
            'REPAIR_PROBLEM',
            'REPAIR_CONTENT',
            'REPAIR_TYPE',
            'EXPECT_TIME',

            \app\models\DropListHelper::attribute($model,'STATUS', \app\models\DropListHelper::repair_notes_status_arr
            ()),
            'REMARK',
            \app\models\Utils::imagesAttribute($model, 'REPAIR_IMG'),

        ],
    ]) ?>

</div>
