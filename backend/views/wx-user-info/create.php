<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\WxUserInfo */

$this->title = 'Create Wx User Info';
$this->params['breadcrumbs'][] = ['label' => 'Wx User Infos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="wx-user-info-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
