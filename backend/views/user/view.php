<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\User */

$this->title = $model->NICKNAME;
$this->params['breadcrumbs'][] = ['label' => '住户详情列表', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('更新', ['update', 'id' => $model->USER_ID], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('删除', ['delete', 'id' => $model->USER_ID], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
//            'USER_ID',
            'NICKNAME',
            'HEADIMGURL:ntext',
            'STATUS',
            'PASSWORD',
            'SEX',
            'PHONE',
            'NEXT_KIN_PHONE',
            'QQ',
            'EMAIL:email',
            'ADDR',
            'WORK_UNIT',
            'CREATE_TIME',
            'UPDATE_TIME',
            'CREATE_USER',
            'UPDATE_USER',
            'REMARK',
        ],
    ]) ?>
    <?php
    if (isset($model->userClient)&&isset($model->userClient->wxInfo)) {
        echo DetailView::widget([
            'model' => $model->userClient->wxInfo,
            'attributes' => [
                [
                    'label' => '微信昵称',
                    'attribute' => 'nickname',
                ],
                [
                    'label' => '微信头像',
                    'format' => 'Image',
                    'attribute' => 'headimgurl',
                ],

            ],
        ]);
    }
    ?>
    <?php
    if (isset($model->userCells)) {

        foreach ($model->userCells as $userCell) {
            echo DetailView::widget([
                'model' => $userCell,
                'attributes' => [
                    'cell.NAME',
                    'build.BUILD_NUM',
                    'house.HOUSE_CODE',
                ],
            ]);
        }
    }
    ?>
</div>
