<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\TRepairWorkNotesSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '报修工单';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="trepair-work-notes-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('添加', ['work-create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'ID',
            'NOTES_ID',
            'PRE_REPAIR_TIME',
            'REAL_REPAIR_TIME',
            'REPAIR_FEE',
            // 'REPAIR_SCHEMA_DIRECT',
            // 'SEND_USER',
            // 'REPAIR_USER',
            // 'REPAIR_USER_PHONE',
            // 'CREATE_TIME',
            // 'OPER_TIME',
            // 'OPER_USER',
            // 'REMARK',

            \app\models\Utils::getDefaultActionColumn()
        ],
    ]); ?>
</div>
