<?php

use yii\helpers\Html;
use yii\grid\GridView;
use app\models\DropListHelper;
use mdm\admin\components\MenuHelper;
use yii\helpers\ArrayHelper;
/* @var $this yii\web\View */
/* @var $searchModel app\models\DeviceSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '设备管理';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="device-index">
    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('新增设备', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

//            'ID',
            ['attribute' => 'CELL_ID',
                'filter' => DropListHelper::auth_cell_str(),
                'content' => function($model, $key, $index, $column) {
                    $typeName = DropListHelper::get_cell($model->CELL_ID);
                    return $typeName;
                }
            ],
            'DEVICE_ID',
            'DEVICE_NAME',
            'SERIAL_NUMBER',
//            'CELL_ID',
            // 'ADDRESS',
            // 'DEPARTID',
            // 'CREATESYSDATE',
            // 'CREATE_TIME',
            // 'UPDATE_TIME',
            // 'CREATE_USER',
            // 'UPDATE_USER',
            // 'REMARK',
            [
                'label' => '操作',
                'format' => 'raw',
                'value' => function($data){
                    $url = "/device/delete?id=" . ArrayHelper::getValue($data, 'ID');
                    return Html::a('删除', $url, ['class'=> 'btn btn-primary btn-sm', 'title' => '删除', 'aria-label' => '删除', 'data-method'=>'post', 'data-confirm'=>'设备删除将删除所有设备钥匙']); 
                }
            ],
            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{view} {update}',
            ],
        ],
    ]); ?>
</div>
