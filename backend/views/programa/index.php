<?php

use app\models\DropListHelper;
use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\ProgramaSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '栏目管理';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="programa-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('新增栏目', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            DropListHelper::column('cell_id', DropListHelper::auth_cell_str()),
            'programa_name',
            DropListHelper::column('programa_type', ['0' => '未设置', '1' => '文章栏目', '2' => '功能栏目']),
            'order',
            DropListHelper::column('is_show', ['0' => '否', '1' => '是']),

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
