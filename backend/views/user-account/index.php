<?php

use app\models\DropListHelper;
use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\UserAccountSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '用户账户';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-account-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('新增账户', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'ID',
            DropListHelper::column('USER_ID', DropListHelper::user_str()),
            'ACCOUNT_TYPE',
            'ACCOUNT_OVER',
            'ACCOUNT_INTEGRAL',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
