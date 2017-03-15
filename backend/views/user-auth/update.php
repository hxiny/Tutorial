<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\DetailView;
use app\models\DropListHelper;

/* @var $this yii\web\View */
/* @var $model app\models\UserAuth */

$this->title = '住户审核: ' . $model->USER_NAME;
$this->params['breadcrumbs'][] = ['label' => '住户审核', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->ID, 'url' => ['view', 'id' => $model->ID]];
$this->params['breadcrumbs'][] = '审核';
?>
<div class="user-auth-update">

    <h1><?= Html::encode($this->title) ?></h1>


    <?= $this->render('view', [
        'model' => $model,
        'userCells' => $userCells,
    ]) ?>


    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
