<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\WxUserInfoSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Wx User Infos';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="wx-user-info-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Wx User Info', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'open_id',
            'nickname',
            'sex',
            'language',
            'city',
            // 'province',
            // 'country',
            // 'headimgurl:url',
            // 'update_time',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
