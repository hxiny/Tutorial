<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\SystemOrganizationSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '机构管理';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="system-organization-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('新增机构', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'organization_id',
            'organization_name',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
