<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\TRepairEvidence */

$this->title = '添加';
$this->params['breadcrumbs'][] = ['label' => 'Trepair Evidences', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="trepair-evidence-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('evidenceForm', [
        'model' => $model,
    ]) ?>

</div>
