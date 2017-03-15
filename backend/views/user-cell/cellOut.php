<?php

use yii\bootstrap\ActiveForm;
use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\UserCell */

$this->title = $model->user->NICKNAME;
$this->params['breadcrumbs'][] = ['label' => '住户列表', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-cell-view">

    <h1><?= Html::encode($this->title) ?></h1>
    <p>
        <?= Html::a('迁出', ['delete', 'id' => $model->ID], [
            'class' => 'btn btn-danger',
        ]) ?>
    </p>
    <?= DetailView::widget([
        'model' => $model->user,
        'attributes' => [
            'USER_ID',
            'NICKNAME',
            'PHONE',
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
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'HOUSE_IDENTITY',
            'cell.NAME',
            'build.BUILD_NUM',
            'house.HOUSE_CODE',
            'STATUS',
            'IS_DEFAULT',
        ],
    ]) ?>


</div>
