<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\CompanyInfo */

$this->title = '编辑公司信息: ' . $model->NAME;
$this->params['breadcrumbs'][] = ['label' => '公司信息', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->NAME, 'url' => ['view', 'id' => $model->ID]];
$this->params['breadcrumbs'][] = '编辑';
?>
<div class="company-info-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'companyList' => $companyList
    ]) ?>

</div>
