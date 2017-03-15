<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Cells */

$this->title = $model->NAME;
$this->params['breadcrumbs'][] = ['label' => '小区列表', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="cells-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('编辑', ['update', 'id' => $model->ID], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('删除', ['delete', 'id' => $model->ID], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => '是否删除?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'ID',
            'PROPERTY_ID',
            'NAME',
            'TYPE',
            'ADDRESS',
            'START_WORK_DATE',
            'COMPLE_WORK_DATE',
            'STAGE',
            'TOTAL_HOUSE',
            'TOTAL_BUILD',
            'BUILD_AREA',
            'COVER_AREA',
            'HOUSE_AREA',
            'STORE_AREA',
            'OFFICE_AREA',
            'CLUB_AREA',
            'GREEN_AREA',
            'PACK_NUM',
            'ENTER_NUM',
            'EXIT_NUM',
            'LONGITUDE',
            'PLANE',
            'CREATE_TIME',
            'UPDATE_TIME',
            'CREATE_USER',
            'UPDATE_USER',
            'REMARK',
            'LATITUDE',
        ],
    ]) ?>

</div>
