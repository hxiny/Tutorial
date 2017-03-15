<?php

use app\models\DropListHelper;
use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\UserCellSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '住户列表';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-cell-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('新增住户', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
//            'ID',
//            'USER_ID',
            'NICKNAME' ,
            'PHONE' ,
//            'NEXT_KIN_PHONE' ,
            'CELL_NAME' ,
            'BUILD_NUM' ,
//            'ADDRESS' ,
            'STOREY' ,
            'HOUSE_CODE' ,
            'HOUSE_IDENTITY',
            \app\models\DropListHelper::column('CELL_ID', \app\models\DropListHelper::auth_cell_str()),

            // 'HOUSE_ID',
            \app\models\DropListHelper::column('STATUS', \app\models\DropListHelper::user_cell_status_arr()),

//             'STATUS',
            // 'IS_DEFAULT',
            ['class' => 'yii\grid\ActionColumn',
                'template' => '{cell-in}{cell-out}{view} {delete}',
                'buttons' => [
                    'cell-in' => function ($url, $model, $key) {
                        return Html::a('迁入/修改', $url, [
                            'title' => '迁入/修改',
                            'aria-label' => Yii::t('yii', 'View'),
                            'data-pjax' => '0',
                            'style' => 'margin-right:5px'
                        ]);
                    },
                    'cell-out' => function ($url, $model, $key) {
                        return Html::a('迁出', $url, [
                            'title' => '迁出',
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
