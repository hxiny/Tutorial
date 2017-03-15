<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\TRepairAudit */

$this->title = '添加';
$this->params['breadcrumbs'][] = ['label' => 'Trepair Audits', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="trepair-audit-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('auditForm', [
        'model' => $model,
    ]) ?>

</div>
