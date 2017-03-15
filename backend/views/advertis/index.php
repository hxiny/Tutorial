<?php

use app\models\DropListHelper;
use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\AdvertisSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '广告管理';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="advertis-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('新增广告', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'ID',
            [
                'attribute' => 'CELL_ID',
                'label' => '小区',
                'filter' => DropListHelper::auth_cell_str(),
                'content' => function($model){
                    return DropListHelper::advertis_cell($model->ID);
                }
            ],
            [
                'attribute' => 'ADVERTIS_TITLE',
                'content' => function($model){
                    return strlen($model->ADVERTIS_TITLE)<=20 ? $model->ADVERTIS_TITLE : mb_substr($model->ADVERTIS_TITLE, 0, 10, 'utf-8').'...';
                } 
            ],
            // [
            //     'attribute' => 'PIC_IMG',
            //     'content' => function($model){
            //         return strlen($model->PIC_IMG)<=20 ? $model->PIC_IMG : substr($model->PIC_IMG, 0, 20).'...';
            //     }
            // ],
            // 'ADVERTIS_URL:url',
            DropListHelper::column('ADVERTIS_TYPE', ['0' => '未设置', '1' => '商家广告', '2' => '文章广告', '3' => '房屋广告']),
            [
                'attribute' => 'ADVERTIS_INTRODUCT',
                'content' => function($model){
                    return strlen($model->ADVERTIS_INTRODUCT)<=20 ? $model->ADVERTIS_INTRODUCT : mb_substr($model->ADVERTIS_INTRODUCT, 0, 10, 'utf-8').'...';
                } 
            ],
            // 'ADVERTIS_START_DATE',
            // 'ADVERTIS_END_DATE',
            // 'STATUS',
            // 'REMARK',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
