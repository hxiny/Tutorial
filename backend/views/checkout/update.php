<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\OwnerBill */

$this->title = '编辑: ' . $model->BILL_ID;
$this->params['breadcrumbs'][] = ['label' => '收银台', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->BILL_ID, 'url' => ['view', 'id' => $model->BILL_ID]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="build-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'payProjectModel' => $payProjectModel,
        'payProjectsArr' => $payProjectsArr,
        'cells' => $cells
    ]) ?>

</div>

