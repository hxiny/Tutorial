<?php

use app\models\DropListHelper;
use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\WxClientInfoSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '公众号设置';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="wx-client-info-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('新增公众号', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'id',
            'name',
            'app_id',
            'gid',
            'mch_id',
            'key',
            // 'ap_secret',
            // 'create_date',
            // 'update_date',
            DropListHelper::column('status', ['0' => '否', '1' => '是']),
            // 'describe:ntext',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
