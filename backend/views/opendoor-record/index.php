<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\OpendoorRecordSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '开门记录';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="opendoor-record-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <!-- <p>
        <?= Html::a('创建开门记录', ['create'], ['class' => 'btn btn-success']) ?>
    </p> -->
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            \app\models\DropListHelper::column('USER_ID', \app\models\DropListHelper::user_str()),
            \app\models\DropListHelper::column('CELL_ID', \app\models\DropListHelper::auth_cell_str()),
            \app\models\DropListHelper::column('DEVICE_ID', \app\models\DropListHelper::device_name_str()),
            'OPEN_TIME',
            'OPEN_RESULT',

            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{view}'
            ],
        ],
    ]); ?>
</div>
