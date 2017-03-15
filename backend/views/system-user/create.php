<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\SystemUser */

$this->title = '新增用户';
$this->params['breadcrumbs'][] = ['label' => '人员管理', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="system-user-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
