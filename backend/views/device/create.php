<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Device */

$this->title = '新增设备';
$this->params['breadcrumbs'][] = ['label' => '设备管理', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="device-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
