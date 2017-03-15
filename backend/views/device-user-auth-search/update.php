<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\DeviceUserAuth */

$this->title = '修改钥匙: ' . $model->ID;
$this->params['breadcrumbs'][] = ['label' => '钥匙管理', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->ID, 'url' => ['view', 'id' => $model->ID]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="device-user-auth-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_formUpdate', [
        'model' => $model,
        'nickName' => $nickName,
    ]) ?>

</div>
