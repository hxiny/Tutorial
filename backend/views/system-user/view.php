<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\SystemUser */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => '人员管理', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="system-user-view">

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
            'username',
            'auth_key',
            'password_hash',
            'password_reset_token',
            'email:email',
            'gender',
            'phone',
            'real_name',
            'status',
            'created_at',
            'updated_at',
        ],
    ]) ?>

</div>
