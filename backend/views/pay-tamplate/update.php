<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\PayTamplate */

$this->title = '更新: ' . $model->tamplate_id;
$this->params['breadcrumbs'][] = ['label' => '收费模板', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->tamplate_id, 'url' => ['view', 'id' => $model->tamplate_id]];
$this->params['breadcrumbs'][] = '更新';
?>
<div class="pay-tamplate-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'formulaTypes' => $formulaTypes,
    ]) ?>

</div>
