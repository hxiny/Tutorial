<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\SmsFormulaData */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => '短信模板配置', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="sms-formula-data-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('更新', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('删除', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => '是否删除?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'variable_name',
            'variable',
            'query_table',
            'query_column',
        ],
    ]) ?>

</div>
