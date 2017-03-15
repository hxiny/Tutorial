<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Build */

$this->title = '新增楼宇';
$this->params['breadcrumbs'][] = ['label' => '楼宇管理', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="build-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
