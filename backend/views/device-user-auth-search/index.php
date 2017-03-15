<?php

use app\models\DropListHelper;
use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\DeviceUserAuthSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '钥匙管理';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="device-user-auth-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('新增钥匙', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'ID',
            [   
                'label' => '楼栋', 
                'attribute' => 'USER_ID', 
                'content' => function($model){
                    return DropListHelper::user_build_num_str($model->USER_ID);
                }
            ],
            [
                'label' => '房号', 
                'attribute' => 'USER_ID', 
                'content' => function($model){
                    return DropListHelper::user_house_code_str($model->USER_ID);
                }
            ],
            DropListHelper::column('USER_ID', DropListHelper::user_str()),
            //'DEVICE_ID',
            'AUID',
            'DEVICE_NAME',
            //'USER_ID',
            // 'KEY_TYPE',
            // 'IS_BINDINGS_WECHAT',
            // 'IS_BINDINGS_MD',
            // 'LOCK_ID',
            'VALIDITY',
            // 'KSID',
            // 'CELL_ID',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
