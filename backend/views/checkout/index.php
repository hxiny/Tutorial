<?php

use app\models\DropListHelper;
use app\models\User;
use app\models\Cells;
use app\models\Build;
use app\models\House;
use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $searchModel app\models\HouseSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '收银台';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="checkout-index">
    <h1><?= Html::encode($this->title) ?></h1>
    <p>
        <?= Html::a('<span class="glyphicon glyphicon-plus"></span> 添加收费', ['create'], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('预存款', ['deposit'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'BILL_ID',
            //['attribute' => 'CELL',
            //    'content' => function($model, $key, $index, $column) {
            //        $house = House::findOne($model->HOUSE_ID);
            //        if ($house) {
            //            $build = Build::findOne($house->BUILD_ID);
            //            if ($build) {
            //                $cell = Cells::findOne($build->CELL_ID);
            //                if ($cell) return $cell->NAME;
            //            }
            //        }
            //        return '';
            //    }
            //],
            //['attribute' => 'BUILD',
            //    'content' => function($model, $key, $index, $column) {
            //        $house = House::findOne($model->HOUSE_ID);
            //        if ($house) {
            //            $build = Build::findOne($house->BUILD_ID);
            //            if ($build) return $build->BUILD_NUM;
            //        }
            //        return '';
            //    }
            //],
            ['attribute' => 'HOUSE_ID',
                'filter' => DropListHelper::house_str(),
                'content' => function($model, $key, $index, $column) {
                    $typeName = DropListHelper::get_house($model->HOUSE_ID);
                    return $typeName;
                }
            ],
            ['attribute' => 'PAY_PROJECT',
                'filter' => DropListHelper::pay_project_str(),
                'content' => function($model, $key, $index, $column) {
                    $typeName = DropListHelper::get_pay_project($model->BILL_ID);
                    return $typeName;
                }
            ],
            ['attribute' => 'PAY_STATUS',
                'filter' => DropListHelper::pay_status_str(),
                'content' => function($model, $key, $index, $column) {
                    $typeName = DropListHelper::get_pay_status($model->PAY_STATUS);
                    return $typeName;
                }
            ],
            ['attribute' => 'PAY_ACCOUNT',
                'content' => function($model, $key, $index, $column) {
                    return ArrayHelper::getValue(User::find()->where(['USER_ID' => $model->PAY_ACCOUNT])->one(), 'NICKNAME');
                }
            ],
            ['attribute' => 'PHONE',
                'content' => function($model, $key, $index, $column) {
                    return ArrayHelper::getValue(User::find()->where(['USER_ID' => $model->PAY_ACCOUNT])->one(), 'PHONE');
                }
            ],
            'PAY_AMOUNT',
            [
                'label'=>'操作',
                'format'=>'raw',
                'value' => function($data){
                    $url = "/checkout/pay?billid=" . ArrayHelper::getValue($data, 'BILL_ID');
                    $payStatus = ArrayHelper::getValue($data, 'PAY_STATUS');
                    if (!$payStatus) {
                        return Html::a('<span class="glyphicon glyphicon-usd"></span>收款', $url, ['class'=> 'btn btn-primary', 'title' => '收款']); 
                    } else {
                        return '';
                    }
                }
            ],   
            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{view} {delete}',
            ],
        ],
    ]); ?>
</div>

