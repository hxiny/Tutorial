<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "wx_client_info".
 *
 * @property integer $id
 * @property string $name
 * @property string $app_id
 * @property string $mch_id
 * @property string $key
 * @property string $ap_secret
 * @property string $create_date
 * @property string $update_date
 * @property integer $status
 * @property string $describe
 */
class WxClientInfo extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'wx_client_info';
    }

    /**
     * @inheritdoc
     */
    public $cell_id;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'app_id', 'gid'], 'required'],
            [['create_date', 'update_date'], 'safe'],
            [['status'], 'integer'],
            [['gid', 'describe'], 'string'],
            [['name', 'app_id', 'mch_id', 'key', 'ap_secret'], 'string', 'max' => 255],
            ['name', 'unique'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => '名称',
            'app_id' => 'AppID',
            'gid' => 'Gid',
            'mch_id' => 'MchID',
            'key' => 'Key',
            'ap_secret' => 'ApSecret',
            'create_date' => '创建时间',
            'update_date' => '更新时间',
            'status' => '状态',
            'describe' => '描述',
        ];
    }
}
