<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\TRepairNotes */

$this->title = '编辑：' . $model->REPAIR_PROBLEM;
$this->params['breadcrumbs'][] = ['label' => '报修申请单', 'url' => ['notes']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="trepair-notes-update">

    <h1><?= Html::encode($this->title) ?></h1>
    <?= $this->render('notesForm', [
        'model' => $model,
    ]) ?>

</div>
