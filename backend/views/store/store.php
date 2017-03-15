<?php

use app\models\DropListHelper;
use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $searchModel app\models\TStoreSearch */
/* @var $holder app\models\Holder */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '商家信息';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tstore-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]);
    ?>
    <?php $form = ActiveForm::begin(); ?>
    <p>
        <?= Html::a('添加', ['store-create'], ['class' => 'btn btn-success']) ?>
        <input type="text" id="holder-delete_ids" class="form-control" name="Holder[delete_ids]" style="display: none">
        <?= Html::submitButton('批量删除', ['class' => 'btn btn-danger gridview']) ?>
    </p>
    <?php ActiveForm::end(); ?>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,

        'options' => [
// ...其他设置项
            'id' => 'grid'
        ],
        'columns' => [

            ['class' => 'yii\grid\SerialColumn'],
//            商家名称、商家分类、商家地址、商家电话
            [
                'class' => 'yii\grid\CheckboxColumn',
                'name' => 'id',
            ],
            'ID',
            'NAME',
//            'PIC_URL:url',
            ['attribute' => 'STORE_TYPE',
                'filter' => DropListHelper::store_type_tr(),
                'content' => function ($model, $key, $index, $column) {
                    $companyName = DropListHelper::get_store_type($model->STORE_TYPE);
                    return $companyName;
                }
            ],
            'ADDRESS',
            'PHONE',
//            'STORE_INTRODUCT',
            // 'STORE_IMG',
            // 'IS_TOP',
            // 'PHONE',
            // 'LANDLINE',
            // 'STAR_LEVEL',
            // 'AWAY_FROM',
            // 'BOSS_NAME',
            // 'BOSS_CERT',
            // 'OPEN_TIME',
            // 'CERT_INFO',
            // 'CREATE_TIME',
            // 'UPDATE_TIME',
            // 'CREATE_USER',
            // 'UPDATE_USER',
            // 'REMARK',
            \app\models\Utils::getDefaultActionColumn(),
        ],
    ]); ?>
</div>

<?php
$this->registerJs('
$(".gridview").on("click", function () {
//注意这里的$("#grid")，要跟我们第一步设定的options id一致
    var keys = $("#grid").yiiGridView("getSelectedRows");
    $("#holder-delete_ids").attr("value", keys);
    console.log($("#holder-delete_ids").attr("value"));
});
');
?>
