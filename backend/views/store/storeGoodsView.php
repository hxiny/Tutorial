<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\TStoreGoods */

$this->title = $model->ID;
$this->params['breadcrumbs'][] = ['label' => 'Tstore Goods', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tstore-goods-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('更新', ['store-goods-update', 'id' => $model->ID], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('删除', ['store-goods-delete', 'id' => $model->ID], [
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
            [
                'attribute'=>'STORE_ID',
                'value'=>\app\models\DropListHelper::get_store($model->STORE_ID),
            ],
            'GOODS_NAME',
            'GOODS_PRICE',
            [
                'attribute'=>'STATUS',
                'value'=>\app\models\DropListHelper::goods_status($model->STATUS),
            ],
            'REMARK',
        ],
    ]) ?>

</div>
