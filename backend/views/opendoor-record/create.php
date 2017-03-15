<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\OpendoorRecord */

$this->title = '新增记录';
$this->params['breadcrumbs'][] = ['label' => 'Opendoor Records', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="opendoor-record-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
