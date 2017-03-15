<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\SmsFormula */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => '短信模板', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="sms-formula-view">

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
            'sms_configuration_id',
            'cell_id',
            'formula_name',
            'variable_set',
        ],
    ]) ?>

</div>
