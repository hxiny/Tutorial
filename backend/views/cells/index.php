<?php

use app\models\DropListHelper;
use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\CellsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '小区信息';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="cells-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('添加小区', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'tableOptions' => ['class' => 'table table-bordered table-hover dataTable'],
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

//            'ID',
            ['attribute' => 'PROPERTY_ID',
                'filter' => DropListHelper::company_str(),
                'content' => function($model, $key, $index, $column) {
                    $companyName = DropListHelper::get_company($model->PROPERTY_ID);
                    return $companyName;
                }
            ],
            DropListHelper::column('ID', DropListHelper::auth_cell_str()),
//            'NAME',
            ['attribute' => 'TYPE',
                'filter' => DropListHelper::cell_type_str(),
                'content' => function($model, $key, $index, $column) {
                    $typeName = DropListHelper::get_cell_type($model->TYPE);
                    return $typeName;
                }
            ],
            'ADDRESS',
            // 'START_WORK_DATE',
            // 'COMPLE_WORK_DATE',
            // 'STAGE',
            // 'TOTAL_HOUSE',
            // 'TOTAL_BUILD',
            // 'BUILD_AREA',
            // 'COVER_AREA',
            // 'HOUSE_AREA',
            // 'STORE_AREA',
            // 'OFFICE_AREA',
            // 'CLUB_AREA',
            // 'GREEN_AREA',
            // 'PACK_NUM',
            // 'ENTER_NUM',
            // 'EXIT_NUM',
            // 'LONGITUDE',
            // 'PLANE',
            // 'CREATE_TIME',
            // 'UPDATE_TIME',
            // 'CREATE_USER',
            // 'UPDATE_USER',
            // 'REMARK',
            // 'LATITUDE',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
