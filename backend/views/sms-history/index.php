<?php

use app\models\DropListHelper;
use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\SmsHistorySearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '短信历史';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="sms-history-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <!-- <p>
        <?= Html::a('Create Sms History', ['create'], ['class' => 'btn btn-success']) ?>
    </p> -->
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'id',
            DropListHelper::column('app_id',DropListHelper::wx_client_info_str()),
            'phone',
            DropListHelper::column('type',['1'=>'验证码']),
            'send_time',

            [
            'class' => 'yii\grid\ActionColumn',
            'template' => '{view}',
            ],
        ],
    ]); ?>
</div>
