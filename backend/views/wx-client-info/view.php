<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\WxClientInfo */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => '公众号设置', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="wx-client-info-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('修改', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('删除', ['delete', 'id' => $model->id], [
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
            'id',
            'name',
            'app_id',
            'gid',
            'mch_id',
            'key',
            'ap_secret',
            'create_date',
            'update_date',
            'status',
            'describe:ntext',
        ],
    ]) ?>

</div>
