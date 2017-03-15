<?php

use app\models\DropListHelper;
use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $searchModel app\models\SystemUserSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '人员管理';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="system-user-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('新增用户', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'id',
            'username',
            //'auth_key',
            //'password_hash',
            //'password_reset_token',
            'email:email',
            DropListHelper::column('gender', ['1'=>'男', '0'=>'女']),
            'phone',
            'real_name',
            // 'status',
            // 'created_at',
            // 'updated_at',
            [
                'label' => '操作',
                'format' => 'raw',
                'value' => function($data){
                    $url = "/auth-assignment-cell/view?id=" . ArrayHelper::getValue($data, 'id');
                    return Html::a('权限管理', $url, ['class'=> 'btn btn-primary btn-xs', 'title' => '权限管理', 'aria-label' => '权限管理', 'data-method'=>'post']); 
                }
            ],

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
