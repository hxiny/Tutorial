<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\ArticleSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="article-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'ID') ?>

    <?= $form->field($model, 'ARTICLE_TITLE') ?>

    <?= $form->field($model, 'ARTICLE_URL') ?>

    <?= $form->field($model, 'ARTICLE_INTRODUCT') ?>

    <?= $form->field($model, 'ARTICLE_TYPE') ?>

    <?php // echo $form->field($model, 'ARTICLE_CONTENT') ?>

    <?php // echo $form->field($model, 'PIC_URL') ?>

    <?php // echo $form->field($model, 'IS_NEW') ?>

    <?php // echo $form->field($model, 'IS_TOP') ?>

    <?php // echo $form->field($model, 'IS_COMMENT') ?>

    <?php // echo $form->field($model, 'COMMENT_NUM') ?>

    <?php // echo $form->field($model, 'HITS') ?>

    <?php // echo $form->field($model, 'USER_ID') ?>

    <?php // echo $form->field($model, 'CREATE_TIME') ?>

    <?php // echo $form->field($model, 'CREATE_USER') ?>

    <?php // echo $form->field($model, 'UPDATE_TIME') ?>

    <?php // echo $form->field($model, 'UPDATE_USER') ?>

    <?php // echo $form->field($model, 'REMARK') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
