<?php

use app\models\DropListHelper;
use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\BuildSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '楼宇管理';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="build-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('添加楼宇', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

//            'ID',
//            ['attribute' => 'CELL_ID',
//                'filter' => DropListHelper::cell_str(),
//                'content' => function($model, $key, $index, $column) {
//                    $typeName = DropListHelper::get_cell($model->CELL_ID);
//                    return $typeName;
//                }
//            ],
            DropListHelper::column('CELL_ID', DropListHelper::auth_cell_str()),
            
//            'AREA_ID',
            'BUILD_NUM',
            'ADDRESS',
             'STOREY_NUM',
            ['attribute' => 'IS_ACCESS',
                'filter' => DropListHelper::boolean_str(),
                'content' => function($model, $key, $index, $column) {
                    $typeName = DropListHelper::get_boolean($model->IS_ACCESS);
                    return $typeName;
                }
            ],
            // 'ELEVATOR_NUM',
            // 'CREATE_TIME',
            // 'UPDATE_TIME',
            // 'CREATE_USER',
            // 'UPDATE_USER',
            // 'REMARK',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
