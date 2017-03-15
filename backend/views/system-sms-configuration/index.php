<?php

use yii\helpers\Html;
use yii\grid\GridView;
use app\models\DropListHelper;

/* @var $this yii\web\View */
/* @var $searchModel app\models\systemSmsConfigurationSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '短信机配置';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="system-sms-configuration-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('新增短信机', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'id',
            DropListHelper::column('company_id', DropListHelper::company_str()),
            DropListHelper::column('app_id', DropListHelper::wx_client_info_str()),
            'configuration_name',
            'app_key',
            'secret_key',
            'extend',
            'sms_type',
            // 'sms_free_sign_name',
            // 'sms_template_code',
            DropListHelper::column('type', ['1' => '短信通知', '2' => '验证码']),

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
