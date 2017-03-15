<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\SystemOrganization */

$this->title = 'Update System Organization: ' . $model->organization_id;
$this->params['breadcrumbs'][] = ['label' => 'System Organizations', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->organization_id, 'url' => ['view', 'id' => $model->organization_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="system-organization-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
