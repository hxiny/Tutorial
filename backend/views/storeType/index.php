<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\TStoreTypeSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Tstore Types';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tstore-type-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Tstore Type', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'ID',
            'TYPE_NAME',
            'TYPE_URL:url',
            'PIC_NAME',
            'SORT',
            // 'REMARK',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
