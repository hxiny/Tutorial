<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Build */

$this->title = '编辑: ' . $model->ID;
$this->params['breadcrumbs'][] = ['label' => '楼宇管理', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->ID, 'url' => ['view', 'id' => $model->ID]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="build-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
