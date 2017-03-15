<?php

use app\models\DropListHelper;
use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\HouseSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '房屋管理';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="house-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('新增房屋', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

//            'ID',
            ['attribute' => 'BUILD_ID',
                'filter' => DropListHelper::build_str(),
                'content' => function($model, $key, $index, $column) {
                    $typeName = DropListHelper::get_build($model->BUILD_ID);
                    return $typeName;
                }
            ],
            'STOREY',
            'HOUSE_CODE',
//            'HOUSE_TYPE',
             'HOUSE_AREA',
            // 'DEVICE_ID',
            // 'POOL_AREA',
            // 'IS_DOUBLE_DECK',
            // 'HOUSE_HEIGHT',
             'ORIENTATION',
            // 'ROOM_NUM',
            // 'HALL_NUM',
            // 'BALCONY_NUM',
            // 'KITCHEN_NUM',
            // 'BATHROOM_NUM',
            // 'CREATE_TIME',
            // 'UPDATE_TIME',
            // 'CREATE_USER',
            // 'UPDATE_USER',
            // 'REMARK',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
