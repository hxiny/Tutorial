<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\House */

$this->title = '编辑: ' . $model->ID;
$this->params['breadcrumbs'][] = ['label' => '房屋管理', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->ID, 'url' => ['view', 'id' => $model->ID]];
$this->params['breadcrumbs'][] = '编辑';
?>
<div class="house-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
