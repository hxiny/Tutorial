<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\House */

$this->title = '添加预存款';
$this->params['breadcrumbs'][] = ['label' => '收银台', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="house-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_depositForm', [
        'model' => $model,
        'cells' => $cells,
    ]) ?>

</div>
