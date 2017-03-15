<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Article */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="article-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'ARTICLE_TITLE')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'ARTICLE_URL')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'ARTICLE_INTRODUCT')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'ARTICLE_TYPE')->dropDownList(['0' => '0', '1' => '1', '2' => '2'], ['prompt' => '请选择文章类型...']) ?>

    <?= $form->field($model,'ARTICLE_CONTENT')->widget('kucha\ueditor\UEditor',[
        'clientOptions'=>[
            'initialFrameWidth' => '100%', 
            'initialFrameHeight' => 300,
            /*'toolbars' => [
                [
                    'fullscreen', 'source', 'undo', 'redo', '|',
                    'fontsize',
                    'bold', 'italic', 'underline', 'fontborder', 'strikethrough', 'removeformat',
                    'formatmatch', 'autotypeset', 'blockquote', 'pasteplain', '|',
                    'forecolor', 'backcolor', '|',
                    'lineheight', '|',
                    'indent', '|'
                ],
            ]*/
            ]
        ])->label('内容'); ?>

    <?= $form->field($model, 'PIC_URL')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'PIC_URL')->fileInput() ?>

    <?= $form->field($model, 'IS_NEW')->radioList(['1' => '是', '0' => '否']) ?>

    <?= $form->field($model, 'IS_TOP')->radioList(['1' => '是', '0' => '否']) ?>

    <?= $form->field($model, 'IS_COMMENT')->radioList(['1' => '是', '0' => '否']) ?>

    <?= $form->field($model, 'COMMENT_NUM')->textInput() ?>

    <?= $form->field($model, 'HITS')->textInput() ?>

    <?= $form->field($model, 'REMARK')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? '新增' : '更新', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
