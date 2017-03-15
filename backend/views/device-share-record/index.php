<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\DeviceShareRecordSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Device Share Records';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="device-share-record-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Device Share Record', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'ID',
            'USER_ID',
            'CELL_ID',
            'SHARE_TIME',
            'OPEN_TIME',
            // 'SHARE_NAME',
            // 'SHARE_PHONE',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
