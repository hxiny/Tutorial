<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\SmsHistory */

$this->title = 'Create Sms History';
$this->params['breadcrumbs'][] = ['label' => 'Sms Histories', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="sms-history-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
