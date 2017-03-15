<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Advertis */

$this->title = $model->ID;
$this->params['breadcrumbs'][] = ['label' => '广告管理', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="advertis-view">

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
            'PIC_IMG',
            'ADVERTIS_URL:url',
            'ADVERTIS_TYPE',
            'ADVERTIS_INTRODUCT',
            'ADVERTIS_TITLE',
            'ADVERTIS_START_DATE',
            'ADVERTIS_END_DATE',
            'STATUS',
            'REMARK',
        ],
    ]) ?>

</div>
