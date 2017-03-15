<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\TRepairEvidenceSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '报修取证表';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="trepair-evidence-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('添加', ['evidence-create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'ID',
            'REPAIR_NOTES_ID',
            'WORK_NOTES_ID',
            'DEAL_BEFORE_PHOTO',
            'DEAL_AFTER_PHOTO',
            // 'REMARK',

            \app\models\Utils::getDefaultActionColumn()
        ],
    ]); ?>
</div>
