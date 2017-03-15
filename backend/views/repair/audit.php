<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\TRepairAuditSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '报修单审核';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="trepair-audit-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('添加', ['audit-create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'ID',
            'NOTES_ID',
            'AUDIT_TIME',
            'AUDIT_USER',
            'AUDIT_RESULT',
            // 'AUDIT_OPTION',
            // 'REMARK',
            \app\models\Utils::getDefaultActionColumn()
        ],
    ]); ?>
</div>
