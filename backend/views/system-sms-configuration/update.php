<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\systemSmsConfiguration */

$this->title = '更新短信机: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => '短信机配置', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = '更新';
?>
<div class="system-sms-configuration-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'appidArray' => $appidArray,
    ]) ?>

</div>
