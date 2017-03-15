<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\TStoreGoods */

$this->title = '添加商品';
$this->params['breadcrumbs'][] = ['label' => '商品管理', 'url' => ['store-goods']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tstore-goods-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('storeGoodsForm', [
        'model' => $model,
    ]) ?>

</div>
