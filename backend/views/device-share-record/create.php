<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\DeviceShareRecord */

$this->title = 'Create Device Share Record';
$this->params['breadcrumbs'][] = ['label' => 'Device Share Records', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="device-share-record-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
