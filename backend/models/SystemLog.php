<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "system_log".
 *
 * @property integer $log_id
 * @property integer $user_id
 * @property string $operation
 * @property string $create_time
 */
class SystemLog extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'system_log';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id', 'operation', 'create_time'], 'required'],
            [['user_id'], 'integer'],
            [['operation'], 'string', 'max' => 200],
            [['create_time'], 'string', 'max' => 30],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'log_id' => '日志ID',
            'user_id' => '用户',
            'operation' => '操作',
            'create_time' => '时间',
        ];
    }

    /**
     * @inheritdoc
     */
    public static function saveLog($controller, $action){
        $model = new self;
        switch ($action) {
            case 'create':
                $action = '新增';
                break;
            case 'update':
                $action = '更新';
                break;
            case 'delete':
                $action = '删除';
                break;    
            default:
                $action = '未改动';
                break;
        }
        $model->user_id = Yii::$app->session['__id'];
        $model->operation = '【'.$action.'】【'.$controller.'】数据！！！';
        $model->create_time = date('Y-m-d H:i:s');
        $model->save();
    }

}
