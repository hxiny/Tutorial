<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\PayFormula */

$this->title = $model->formula_id;
$this->params['breadcrumbs'][] = ['label' => '公式管理', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pay-formula-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->formula_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->formula_id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'formula_id',
            'formula_name',
            'formula_type',
            'formula_text',
        ],
    ]) ?>

</div>
