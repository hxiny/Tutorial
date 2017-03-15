<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\DeviceParams */

$this->title = $model->ID;
$this->params['breadcrumbs'][] = ['label' => '门禁配置', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="device-params-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('更新', ['update', 'id' => $model->ID], ['class' => 'btn btn-primary']) ?>
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
            'APP_ID',
            'GID',
            'AGT_NUM',
            'MD_BINDINGS_URL:url',
            'MD_OPENDOOR_URL:url',
            'MD_SHARE_URL:url',
            'APP_KEY',
        ],
    ]) ?>

</div>
