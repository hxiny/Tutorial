<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\TStoreType */
/* @var $storeTypeCell app\models\TStoreTypeCell */

$this->title = $model->ID;
$this->params['breadcrumbs'][] = ['label' => '商家分类', 'url' => ['store-type']];
$this->params['breadcrumbs'][] = $model->TYPE_NAME;
?>
<div class="tstore-type-view">

    <h1><?= Html::encode($model->TYPE_NAME) ?></h1>

    <p>
        <?= Html::a('更新', ['store-type-update', 'id' => $model->ID], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('删除', ['store-type-delete', 'id' => $model->ID], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>
    <?= DetailView::widget([
        'model' => $storeTypeCell,
        'attributes' => [
            \app\models\DropListHelper::attribute($storeTypeCell, 'CELL_ID', \app\models\DropListHelper::cell_str()),
            \app\models\DropListHelper::attribute($storeTypeCell, 'STATUS', \app\models\DropListHelper::store_type_cell_status_dictionary_arr()),
        ],
    ]) ?>
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'ID',
            'TYPE_NAME',
            'TYPE_URL:url',
            'PIC_NAME',
            'SORT',
            'REMARK',
        ],
    ]) ?>

</div>
