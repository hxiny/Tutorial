<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\DeviceParams */

$this->title = '新增配置';
$this->params['breadcrumbs'][] = ['label' => '门禁配置', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="device-params-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
