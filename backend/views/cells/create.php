<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Cells */

$this->title = '添加小区';
$this->params['breadcrumbs'][] = ['label' => '小区列表', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="cells-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
