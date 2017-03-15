<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\PayFormula */

$this->title = '新增';
$this->params['breadcrumbs'][] = ['label' => '公式管理', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pay-formula-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
