<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\WxUserInfo */

$this->title = 'Update Wx User Info: ' . $model->open_id;
$this->params['breadcrumbs'][] = ['label' => 'Wx User Infos', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->open_id, 'url' => ['view', 'id' => $model->open_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="wx-user-info-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
