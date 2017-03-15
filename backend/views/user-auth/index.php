<?php

use yii\helpers\Html;
use yii\grid\GridView;
use app\models\DropListHelper;

/* @var $this yii\web\View */
/* @var $searchModel app\models\UserAuthSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '住户审核';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-auth-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php //echo $this->render('_search', ['model' => $searchModel]); ?>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
//            ['label' => '小区', 'attribute' => 'NAME', 'value' => 'cell.CELL_NAME'],
            DropListHelper::column('CELL_ID', DropListHelper::auth_cell_str()),
//        'CELL_NAME',
            'USER_NAME',
            ['label' => '昵称', 'attribute' => 'NICKNAME', 'value' => 'user.NICKNAME'],

            ['label' => '手机', 'attribute' => 'PHONE', 'value' => 'user.PHONE'],
            [
                'label' => '状态',
                'attribute' => 'AUTH_STATUS',
                'filter' => DropListHelper::user_auth_status_str(1),
                'content' => function ($model) {
                    return DropListHelper::get_user_auth_status($model->AUTH_STATUS);
                }
            ],
            ['label' => '近亲电话', 'attribute' => 'NEXT_KIN_PHONE', 'value' => 'user.NEXT_KIN_PHONE'],
            ['label' => '申请时间', 'attribute' => 'CREATE_TIME', 'value' => 'user.CREATE_TIME'],

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
