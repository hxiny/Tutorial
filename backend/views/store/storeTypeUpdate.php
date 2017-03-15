<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\TStoreType */

$this->title = '更新：' . $model->ID;
$this->params['breadcrumbs'][] = ['label' => '商家分类', 'url' => ['store-type']];
$this->params['breadcrumbs'][] = $this->title ;
?>
<div class="tstore-type-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('storeTypeForm', [
        'model' => $model,
        'storeTypeCell' => $storeTypeCell,

    ]) ?>

</div>
