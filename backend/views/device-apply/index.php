<?php

use app\models\DropListHelper;
use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\DeviceApplySearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '钥匙审核';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="device-apply-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
    <!--
    <p>
        <?= Html::a('Create Device Apply', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    -->
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            ['attribute' => 'CELL_ID',
                'filter' => DropListHelper::auth_cell_str(),
                'content' => function($model, $key, $index, $column) {
                    $typeName = DropListHelper::get_cell($model->CELL_ID);
                    return $typeName;
                }
            ],
            ['attribute' => 'USER_ID',
                'filter' => DropListHelper::nickname_str(),
                'content' => function($model, $key, $index, $column) {
                    $typeName = DropListHelper::get_user($model->USER_ID);
                    return $typeName;
                }
            ],
            'DEVICE_ID',
            'VALIDITY',
            'APPLY_TIME',
            ['attribute' => 'AUDIT_STATUS',
                'filter' => DropListHelper::device_audit_status_str(),
                'content' => function($model, $key, $index, $column) {
                    $typeName = DropListHelper::get_device_audit_status_str($model->AUDIT_STATUS);
                    return $typeName;
                }
            ],
            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
