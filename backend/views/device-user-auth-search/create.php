<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\DeviceUserAuth */

$this->title = '新增钥匙';
$this->params['breadcrumbs'][] = ['label' => '钥匙管理', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="device-user-auth-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'cells' => $cells,
    ]) ?>

</div>
