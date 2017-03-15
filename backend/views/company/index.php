<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\CompanyInfoSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '公司信息';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="company-info-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('添加公司', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'pager' => [
            'firstPageLabel' => '首页',
            'prevPageLabel' => '上一页',
            'nextPageLabel' => '下一页',
            'lastPageLabel' => '尾页',
        ],
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

//            'ID',
            'NAME',
            'ADDRESS',
            'SET_DATE',
            'CHARGE_MAN',
            // 'CORPORATE',
            // 'CREDIT_CODE',
            // 'ENTERPRISE_TYPE',
            // 'ORGANIZATION_CODE',
            // 'CREATE_TIME',
            // 'UPDATE_TIME',
            // 'CREATE_USER',
            // 'UPDATE_USER',
            // 'REMARK',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
