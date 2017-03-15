<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Dictionary */

$this->title = $model->NAME;
$this->params['breadcrumbs'][] = ['label' => '系统字典', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="dictionary-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'TYPE_NAME' => $model->TYPE_NAME, 'CODE' => $model->CODE], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'TYPE_NAME' => $model->TYPE_NAME, 'CODE' => $model->CODE], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'TYPE_NAME',
            'CODE',
            'NAME',
            'SORT',
        ],
    ]) ?>

</div>
