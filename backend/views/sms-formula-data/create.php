<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\SmsFormulaData */

$this->title = '新增配置';
$this->params['breadcrumbs'][] = ['label' => '短信模板配置', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="sms-formula-data-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
