<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\SystemMenu */

$this->title = $model->ID;
$this->params['breadcrumbs'][] = ['label' => '菜单设置', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="system-menu-view">

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
            'MODULE_NAME',
            'MODULE_URL:url',
            'PIC_NAME',
            'SORT',
            'REMARK',
        ],
    ]) ?>

</div>
