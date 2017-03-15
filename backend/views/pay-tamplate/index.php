<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\PayTamplateSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '收费模板';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pay-tamplate-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('新增模板', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'tamplate_id',
            'tamplate_name',
            'cell_id',
            'build_id',
            'accuracy',
            'formula_types',
            'unit_cost',
            'period',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
