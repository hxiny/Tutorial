<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Cells */

$this->title = '编辑: ' . $model->NAME;
$this->params['breadcrumbs'][] = ['label' => '小区列表', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->NAME, 'url' => ['view', 'id' => $model->ID]];
$this->params['breadcrumbs'][] = '编辑';
?>
<div class="cells-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
