<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\SystemOrganization */

$this->title = '新增机构';
$this->params['breadcrumbs'][] = ['label' => '机构管理', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="system-organization-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
