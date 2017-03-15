<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\TRepairWorkNotes */

$this->title = '编辑: ' . $model->ID;
$this->params['breadcrumbs'][] = ['label' => '报修工单', 'url' => ['work']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="trepair-work-notes-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('workForm', [
        'model' => $model,
    ]) ?>

</div>
