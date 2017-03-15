<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\PayTamplate */

$this->title = '新增模板';
$this->params['breadcrumbs'][] = ['label' => '收费模板', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pay-tamplate-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'formulaTypes' => $formulaTypes,
    ]) ?>

</div>
