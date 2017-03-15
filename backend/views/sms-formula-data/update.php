<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\SmsFormulaData */

$this->title = '更新配置: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => '短信模板配置', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = '更新';
?>
<div class="sms-formula-data-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
