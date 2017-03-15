<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\TRepairNotes */

$this->title = '添加报修单';
$this->params['breadcrumbs'][] = ['label' => '报修申请单', 'url' => ['notes']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="trepair-notes-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('notesForm', [
        'model' => $model,
    ]) ?>

</div>
