<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\House */

$this->title = '添加收费';
$this->params['breadcrumbs'][] = ['label' => '收银台', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="house-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'payProjectModel' => $payProjectModel,
        'cells' => $cells,
    ]) ?>

</div>

