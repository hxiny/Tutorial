<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\TRepairNotesSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '报修申请单';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="trepair-notes-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('添加', ['notes-create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'NICKNAME',
            'REPAIR_TIME',
            \app\models\DropListHelper::column('REPAIR_PROJECT', \app\models\DropListHelper::repair_project_arr()),

//            'REPAIR_PROJECT',
            'REPAIR_PROBLEM',
            // 'REPAIR_CONTENT',
            // 'REPAIR_TYPE',
            // 'REPAIR_IMG',
            // 'CELL_ID',
            // 'BUILD_NUM',
            // 'HOUSE_CODE',
             'PHONE',
            // 'EXPECT_TIME',
            \app\models\DropListHelper::column('STATUS', \app\models\DropListHelper::repair_notes_status_arr()),
            // 'CREATE_TIME',
//             'CREATE_USER',
            // 'UPDATE_TIME',
            // 'UPDATE_USER',
            // 'REMARK',
            \app\models\Utils::getDefaultActionColumn()
        ],
    ]); ?>
</div>
