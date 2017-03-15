<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\UserSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '用户列表';
$this->params['breadcrumbs'][] = $this->title;
$from =json_encode($from);
$this->registerJs("var _from = {$from};");
$this->registerJs($this->render('_script.js'));
?>
<div class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel"
     style="display: none;">
    <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content">

            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                        aria-hidden="true">×</span></button>
                <h4 class="modal-title" id="mySmallModalLabel">提示</h4>
            </div>
            <div class="modal-body">
                该用户没有认证信息
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>
<div class="user-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('新增用户', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
//            'USER_ID',
            'NICKNAME',
//            'HEADIMGURL:ntext',
            'STATUS',
//            'PASSWORD',
            'SEX',
            'PHONE',
            'NEXT_KIN_PHONE',
            'QQ',
            'EMAIL:email',
//             'ADDR',
//             'WORK_UNIT',
//            [
//                'label' => '微信昵称',
//                'attribute' => 'userClient.wxInfo.nickname',
//                'value'=> function ($model) {
//                    if (isset($model->userClient)&&isset($model->userClient->wxInfo)) {
//                        return $model->userClient->wxInfo->nickname;
//                    }
//                    return null;
//                }
//            ],

            // 'CREATE_TIME',
            // 'UPDATE_TIME',
            // 'CREATE_USER',
            // 'UPDATE_USER',
//             'REMARK',
            ['class' => 'yii\grid\ActionColumn',
                'template' => '{cell-in}{user-auth}{bind-wx}{unbind-wx}{view} {update} {delete}',
                'buttons' => [

                    'bind-wx' => function ($url, $model, $key) {
                        return Html::a('绑定微信', $url, [
                            'title' => '绑定微信',
                            'aria-label' => Yii::t('yii', 'View'),
                            'data-pjax' => '0',
                            'style' => 'margin-right:5px'
                        ]);
                    },
                    'cell-in' => function ($url, $model, $key) {
                        return Html::a('迁入', $url, [
                            'title' => '绑定微信',
                            'aria-label' => Yii::t('yii', 'View'),
                            'data-pjax' => '0',
                            'style' => 'margin-right:5px'
                        ]);
                    },
                    'user-auth' => function ($url, $model, $key) {
                        return Html::a('认证用户', $url, [
                            'title' => '绑定微信',
                            'aria-label' => Yii::t('yii', 'View'),
                            'data-pjax' => '0',
                            'style' => 'margin-right:5px'
                        ]);
                    }
                ]
            ],
        ],
    ]); ?>
</div>