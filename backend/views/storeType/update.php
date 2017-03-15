<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\TStoreType */

$this->title = 'Update Tstore Type: ' . $model->ID;
$this->params['breadcrumbs'][] = ['label' => 'Tstore Types', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->ID, 'url' => ['view', 'id' => $model->ID]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="tstore-type-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
