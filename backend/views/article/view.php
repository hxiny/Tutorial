<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Article */

$this->title = $model->ID;
$this->params['breadcrumbs'][] = ['label' => 'Articles', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="article-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->ID], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->ID], [
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
            'ID',
            'ARTICLE_TITLE',
            'ARTICLE_URL:url',
            'ARTICLE_INTRODUCT',
            'ARTICLE_TYPE',
            'ARTICLE_CONTENT:ntext',
            'PIC_URL:url',
            'IS_NEW',
            'IS_TOP',
            'IS_COMMENT',
            'COMMENT_NUM',
            'HITS',
            'USER_ID',
            'CREATE_TIME',
            'CREATE_USER',
            'UPDATE_TIME',
            'UPDATE_USER',
            'REMARK',
        ],
    ]) ?>

</div>
