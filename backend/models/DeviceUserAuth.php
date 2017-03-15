<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "t_device_user_auth".
 *
 * @property integer $ID
 * @property string $DEVICE_ID
 * @property string $DEVICE_NAME
 * @property string $AUID
 * @property string $USER_ID
 * @property string $KEY_TYPE
 * @property string $IS_BINDINGS_WECHAT
 * @property string $IS_BINDINGS_MD
 * @property string $LOCK_ID
 * @property string $VALIDITY
 * @property string $KSID
 * @property string $CELL_ID
 * @property string $PID
 * @property string $MTYPE
 * @property string $STATUS
 * @property string $KEY_SECRET
 */
class DeviceUserAuth extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 't_device_user_auth';
    }

    /**
     * @inheritdoc
     */
    public $HOUSE_ID;
    public $NICKNAME;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['DEVICE_ID', 'USER_ID', 'CELL_ID'], 'string', 'max' => 32],
            [['DEVICE_NAME'], 'string', 'max' => 100],
            [['AUID'], 'string', 'max' => 15],
            [['KEY_TYPE', 'IS_BINDINGS_WECHAT', 'IS_BINDINGS_MD', 'MTYPE', 'STATUS'], 'string', 'max' => 1],
            [['LOCK_ID'], 'string', 'max' => 200],
            [['VALIDITY'], 'string', 'max' => 24],
            [['KSID', 'KEY_SECRET'], 'string', 'max' => 50],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'ID' => 'ID',
            'HOUSE_ID' => '所属房屋',
            'DEVICE_ID' => '设备编号',
            'DEVICE_NAME' => '设备名称',
            'PID' => '门禁编号',
            'AUID' => '手机号码',
            'USER_ID' => '用户名称',
            'KEY_TYPE' => '钥匙类型(0是业主钥匙，1是访客钥匙)',
            'IS_BINDINGS_WECHAT' => '是否绑定微信',
            'IS_BINDINGS_MD' => '是否绑定秒兜',
            'LOCK_ID' => '接口凭证',
            'VALIDITY' => '钥匙有有效期',
            'KSID' => '门禁钥匙',
            'CELL_ID' => '小区编号',
        ];
    }
}
