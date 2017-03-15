<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\PayFormula */

$this->title = '更新公式: ' . $model->formula_id;
$this->params['breadcrumbs'][] = ['label' => '公式管理', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->formula_id, 'url' => ['view', 'id' => $model->formula_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="pay-formula-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
