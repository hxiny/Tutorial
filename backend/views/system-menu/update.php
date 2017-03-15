<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\SystemMenu */

$this->title = '更新菜单: ' . $model->ID;
$this->params['breadcrumbs'][] = ['label' => '菜单设置', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->ID, 'url' => ['view', 'id' => $model->ID]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="system-menu-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'cells' => $cells,
    ]) ?>

</div>
