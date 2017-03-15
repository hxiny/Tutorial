<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\House */

$this->title = $model->ID;
$this->params['breadcrumbs'][] = ['label' => '房屋管理', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="house-view">

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
            'BUILD_ID',
            'STOREY',
            'HOUSE_CODE',
            'HOUSE_TYPE',
            'HOUSE_AREA',
            'DEVICE_ID',
            'POOL_AREA',
            'IS_DOUBLE_DECK',
            'HOUSE_HEIGHT',
            'ORIENTATION',
            'ROOM_NUM',
            'HALL_NUM',
            'BALCONY_NUM',
            'KITCHEN_NUM',
            'BATHROOM_NUM',
            'CREATE_TIME',
            'UPDATE_TIME',
            'CREATE_USER',
            'UPDATE_USER',
            'REMARK',
        ],
    ]) ?>

</div>
