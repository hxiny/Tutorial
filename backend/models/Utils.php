<?php
/**
 * Created by PhpStorm.
 * User: yorun
 * Date: 2016/12/17
 * Time: 19:40
 */

namespace app\models;


use mdm\admin\models\Menu;
use Yii;
use yii\base\Exception;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\web\UploadedFile;
use yii\web\View;

class Utils
{
    public static  $ADMIN_NAME= '系统管理员';
    /**
     *
     * $model 需要实现CanModular
     * @return array
     */
    public static function getDefaultActionColumn()
    {
        function checkModelForCanModular($model)
        {
            if (!($model instanceof CanModular)) {
                throw  new Exception("model is not CanModular");
            }
        }

        return ['class' => 'yii\grid\ActionColumn',
            'template' => '{view}{update}{delete}',
            'buttons' => [
                'update' => function ($url, $model, $key) {
                    /**
                     * @param $model
                     * @throws Exception
                     */
                    checkModelForCanModular($model);
                    return Html::a(
                        '<span class="glyphicon glyphicon-pencil"></span>',
                        $model->getModuleName() . '-update?id=' . $key
                    );
                },
                'view' => function ($url, $model, $key) {
                    checkModelForCanModular($model);
                    return Html::a(
                        '<span class="glyphicon glyphicon-eye-open"></span>',
                        $model->getModuleName() . '-view?id=' . $key  //这里就可以加各种参数了，调用各种挂件
                    );
                },
                'delete' => function ($url, $model, $key) {
                    checkModelForCanModular($model);
                    return Html::a(
                        '<span class="glyphicon glyphicon-trash"></span>',
                        $model->getModuleName() . '-delete?id=' . $key,  //这里就可以加各种参数了，调用各种挂件
                        ['data-confirm' => "您确定要删除此项吗？"]
                    );
                },
            ],
        ];
    }

    public static function upload($model, $attr, $dir = 'upload/')
    {
        if (Yii::$app->request->isPost) {
            $file = UploadedFile::getInstance($model, $attr);
            if (!isset($file)) {
                return true;
            }
//文件上传存放的目录
            if (!is_dir($dir))
                mkdir($dir);
//文件名
            $fileName = date("HiiHsHis") . "." . $file->extension;
            $dir = $dir . $fileName;
            $file->saveAs($dir);
            $model[$attr] = Url::toRoute($dir, true);
            return true;
        }
        return false;
    }

    public static function datetimeOptions(array $option = [])
    {
        return ArrayHelper::merge([
            'pluginOptions' => [
                'autoclose' => true
            ]
        ], $option);
    }

    /**
     * @param $images
     */
    public static function htmlImages($images)
    {
        if (!isset($images)||empty($images)) {
            return null;
        }
        $images = str_replace("'", "\"", $images);
        $imageArr = json_decode($images, true);
        $value = "";
        foreach ($imageArr as $item) {
            $value .= Html::img($item['url'], ['style' => 'margin-right:20px']);
        }
        return $value;
    }

    public static function imagesAttribute($model, $attr)
    {
        return [
            'attribute' => $attr,
            'value' => \app\models\Utils::htmlImages($model->$attr),
            'format' => ['html'],
        ];
    }

    /**
     * 获取该管理员所管理的小区
     */
    public static function authCells()
    {
//        $assignment = AuthAssignmentCell::find()->asArray()->where(['user_id' => Yii::$app->getUser()->getId()])->all();
//        $cellIds=ArrayHelper::getColumn($assignment, 'cell_id');

        $roles=Yii::$app->authManager->getRolesByUser(Yii::$app->getUser()->getId());

        //管理员返回所有小区列表
        foreach ($roles as $role) {
            if (array_key_exists(self::$ADMIN_NAME,$role)) {
                $arr = Cells::find()->asArray()->all();
                return ArrayHelper::getColumn($arr, 'ID');
            }
        }

        //非系统管理员 返回当前路径下 所管辖的小区
        $authItemChilds = AuthItemChild::find()->asArray()->where(['child' => '/'.YII::$app->request->getPathInfo()])
        ->all();
        $authAssignmentCells = AuthAssignmentCell::find()->asArray()->where(['item_name' => ArrayHelper::getColumn
        ($authItemChilds, 'parent'),
            'user_id'=>Yii::$app->getUser()->getId()
        ])->all();
        $cellIds = ArrayHelper::getColumn($authAssignmentCells, 'cell_id');
        return $cellIds;

    }

    public function test()
    {
    }
}