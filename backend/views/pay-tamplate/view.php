<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\PayTamplate */

$this->title = $model->tamplate_name;
$this->params['breadcrumbs'][] = ['label' => '收费模板', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pay-tamplate-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('更新', ['update', 'id' => $model->tamplate_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('删除', ['delete', 'id' => $model->tamplate_id], [
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
            'tamplate_id',
            'tamplate_name',
            'cell_id',
            'build_id',
            'accuracy',
            'formula_types',
            'unit_cost',
            'period',
        ],
    ]) ?>

</div>
