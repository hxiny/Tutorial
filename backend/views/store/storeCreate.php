<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\TStore */

$this->title = '添加商家';
$this->params['breadcrumbs'][] = ['label' => '商家管理', 'url' => ['store']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tstore-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('storeForm', [
        'model' => $model,
        'cell' =>$cell,
    ]) ?>

</div>
