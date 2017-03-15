<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\SystemMenu */

$this->title = '新增菜单';
$this->params['breadcrumbs'][] = ['label' => '菜单设置', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="system-menu-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'cells' => $cells,
    ]) ?>

</div>
