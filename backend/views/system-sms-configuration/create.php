<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\systemSmsConfiguration */

$this->title = '新增短信机';
$this->params['breadcrumbs'][] = ['label' => '短信机配置', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="system-sms-configuration-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
