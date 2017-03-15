<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\UserCell */

$this->title = '住户详情';
$this->params['breadcrumbs'][] = ['label' => '住户列表', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->ID, 'url' => ['view', 'id' => $model->ID]];
$this->params['breadcrumbs'][] = '更新';
?>
<div class="user-cell-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
