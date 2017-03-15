<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\ArticleSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '文章管理';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="article-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php  //echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('新增文章', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            //['class' => 'yii\grid\SerialColumn'],

            'ID',
            'ARTICLE_TITLE',
            'ARTICLE_URL:url',
            [
                'attribute' => 'ARTICLE_INTRODUCT',
                'content' => function($model){
                    return mb_substr($model->ARTICLE_INTRODUCT, 0, 15, 'utf-8').'...';
                }
            ],
            'ARTICLE_TYPE',
            'ARTICLE_CONTENT:ntext',
            // 'PIC_URL:url',
            // 'IS_NEW',
            // 'IS_TOP',
            // 'IS_COMMENT',
            // 'COMMENT_NUM',
            // 'HITS',
            // 'USER_ID',
            // 'CREATE_TIME',
            // 'CREATE_USER',
            // 'UPDATE_TIME',
            // 'UPDATE_USER',
            // 'REMARK',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
