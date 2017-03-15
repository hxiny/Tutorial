<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\WxClientInfo */

$this->title = '公众号设置: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => '公众号信息', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = '修改';
?>
<div class="wx-client-info-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
