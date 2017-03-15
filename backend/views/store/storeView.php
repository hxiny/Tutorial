<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\TStore */

$this->title = $model->NAME;
$this->params['breadcrumbs'][] = ['label' => '商家管理', 'url' => ['store']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tstore-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('更新', ['store-update', 'id' => $model->ID], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('刪除', ['store-delete', 'id' => $model->ID], [
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
            'CELL_NAME',
            'NAME',
//            \app\models\Utils::imageAttribute($model,)
            'PIC_URL:image',
            'STORE_TYPE',
            'STORE_INTRODUCT',
            \app\models\Utils::imagesAttribute($model,'STORE_IMG'),
            'IS_TOP',
            'PHONE',
            'LANDLINE',
            'STAR_LEVEL',
            'AWAY_FROM',
            'ADDRESS',
            'BOSS_NAME',
            'BOSS_CERT',
            'OPEN_TIME',
            \app\models\Utils::imagesAttribute($model,'CERT_INFO'),
            'REMARK',
        ],
    ]) ?>

</div>
