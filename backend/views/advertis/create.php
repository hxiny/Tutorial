<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Advertis */

$this->title = '新增广告';
$this->params['breadcrumbs'][] = ['label' => '广告管理 ', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="advertis-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
