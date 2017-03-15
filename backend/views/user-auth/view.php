<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use app\models\DropListHelper;

/* @var $this yii\web\View */
/* @var $model app\models\UserAuth */
/* @var $user app\models\User */

$this->title = $model->USER_NAME;
$this->params['breadcrumbs'][] = ['label' => '住户审核', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-auth-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'USER_NAME',
            'user.NICKNAME',
            'user.HEADIMGURL:image',
            'user.SEX',
            'user.PHONE',
            'user.NEXT_KIN_PHONE',
            'user.QQ',
            'user.EMAIL',
            'user.ADDR',
            'user.WORK_UNIT',
        ],
    ]) ?>
    <?php
    foreach ($userCells as $userCell) {
        echo DetailView::widget([
            'model' => $userCell,
            'attributes' => [
                ['label' => '小区',
                    'value' => $model->cell->NAME],
                //build
//                'build.ID',
//                'build.CELL_ID',
                'build.area.AREA_NAME',
                'build.BUILD_NUM',
                'build.ADDRESS',
                'build.STOREY_NUM',
                'HOUSE_IDENTITY',
                ['attribute' => 'STATUS',
                    'value' => DropListHelper::user_cell_status($userCell->STATUS)],
            ],
        ]);
    }
    ?>
    <?php
    if (isset($model->user)&&isset($model->user->userClient)&&isset($model->user->userClient->wxInfo)) {
        echo DetailView::widget([
            'model' => $model->user->userClient->wxInfo,
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
            'CERT_ID',
//            'CERT_IMG:ntext',
            \app\models\Utils::imagesAttribute($model, 'CERT_IMG'),
            DropListHelper::attribute($model,'AUTH_FLOW',DropListHelper::user_auth_flow_arr()),
            ['label' => '审核状态', 'attribute' => 'AUTH_STATUS',
                'value' => DropListHelper::get_user_auth_status($model->AUTH_STATUS)],
            'AUTH_LIMIT',
            'REMARK',
            'userCert.MAN_CERT',
            'userCert.HOUSE_CERT',
        ],
    ]) ?>

</div>
