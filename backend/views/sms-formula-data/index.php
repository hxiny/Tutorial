<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\SmsFormulaDataSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '短信模板配置';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="sms-formula-data-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('新增配置', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'id',
            'variable_name',
            'variable',
            'query_table',
            'query_column',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
