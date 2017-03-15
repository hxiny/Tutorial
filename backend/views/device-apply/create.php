<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\DeviceApply */

$this->title = 'Create Device Apply';
$this->params['breadcrumbs'][] = ['label' => 'Device Applies', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="device-apply-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
