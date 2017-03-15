<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\SystemMenuSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '菜单设置';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="system-menu-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('新增菜单', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'ID',
            'MODULE_NAME',
            'MODULE_URL:url',
            'PIC_NAME',
            'SORT',
            // 'REMARK',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
