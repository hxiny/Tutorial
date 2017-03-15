<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\WxClientInfo */

$this->title = '公众号创建';
$this->params['breadcrumbs'][] = ['label' => '新增公众号信息', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="wx-client-info-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
