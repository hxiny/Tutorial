<?php

use app\models\DropListHelper;
use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\DeviceParamsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '门禁配置';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="device-params-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('新增配置', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            DropListHelper::column('APP_ID',DropListHelper::wx_client_info_str()),
            'GID',
            'AGT_NUM',
            [
                'attribute' => 'MD_BINDINGS_URL',
                'content' => function($model){
                    return strlen($model->MD_BINDINGS_URL)<=20 ? $model->MD_BINDINGS_URL : substr($model->MD_BINDINGS_URL, 0, 20).'...';
                }
            ],
            [
                'attribute' => 'MD_OPENDOOR_URL',
                'content' => function($model){
                    return strlen($model->MD_OPENDOOR_URL)<=20 ? $model->MD_OPENDOOR_URL : substr($model->MD_OPENDOOR_URL, 0, 20).'...';
                }
            ],
            [
                'attribute' => 'MD_SHARE_URL',
                'content' => function($model){
                    return strlen($model->MD_SHARE_URL)<=20 ? $model->MD_OPENDOOR_URL : substr($model->MD_SHARE_URL, 0, 20).'...';
                }
            ],
            [
                'attribute' => 'APP_KEY',
                'content' => function($model){
                    return strlen($model->APP_KEY) <= 20 ? $model->APP_KEY : substr($model->APP_KEY, 0, 20).'...';
                }
            ],

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
