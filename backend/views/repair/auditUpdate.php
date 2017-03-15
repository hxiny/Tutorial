<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\TRepairAudit */

$this->title = '編輯: ' . $model->ID;
$this->params['breadcrumbs'][] = ['label' => 'Trepair Audits', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->ID, 'url' => ['view', 'id' => $model->ID]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="trepair-audit-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('auditForm', [
        'model' => $model,
    ]) ?>

</div>
