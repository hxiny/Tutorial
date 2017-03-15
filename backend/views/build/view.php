<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Build */

$this->title = $model->ID;
$this->params['breadcrumbs'][] = ['label' => '楼宇管理', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="build-view">

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
            'CELL_ID',
            'AREA_ID',
            'BUILD_NUM',
            'ADDRESS',
            'STOREY_NUM',
            'IS_ACCESS',
            'ELEVATOR_NUM',
            'CREATE_TIME',
            'UPDATE_TIME',
            'CREATE_USER',
            'UPDATE_USER',
            'REMARK',
        ],
    ]) ?>

</div>
