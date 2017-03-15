<?php

use yii\helpers\Html;
use yii\grid\GridView;
use app\models\DropListHelper;

/* @var $this yii\web\View */
/* @var $searchModel app\models\SmsFormulaSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '短信模板';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="sms-formula-index">

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

            //'id',
            DropListHelper::column('sms_configuration_id', DropListHelper::sms_configuration()),
            DropListHelper::column('cell_id', DropListHelper::auth_cell_str()),
            'formula_name',
            [
                'attribute' => 'variable_set',
                'content' => function($model){
                    return \app\models\SmsFormula::variableSet($model->variable_set);
                }
            ],

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
