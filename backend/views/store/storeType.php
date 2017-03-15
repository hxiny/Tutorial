<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\TStoreTypeSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '商家分类';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tstore-type-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('添加', ['store-type-create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            \app\models\DropListHelper::column('CELL_ID', \app\models\DropListHelper::auth_cell_str()),
            'TYPE_NAME',
            'TYPE_URL:url',
            'PIC_NAME',
            'SORT',
            // 'REMARK',
            \app\models\Utils::getDefaultActionColumn()
        ],
    ]); ?>
</div>
