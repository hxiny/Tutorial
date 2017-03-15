<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\OpendoorRecord */

$this->title = '修改开门记录: ' . $model->ID;
$this->params['breadcrumbs'][] = ['label' => 'Opendoor Records', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->ID, 'url' => ['view', 'id' => $model->ID]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="opendoor-record-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
