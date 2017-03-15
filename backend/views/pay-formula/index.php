<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\PayFormulaSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '公式管理';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pay-formula-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('新增公式', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'formula_id',
            'formula_name',
            'formula_text',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
