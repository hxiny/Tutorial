<?php

namespace app\models;

use Yii;
use Qiniu\Zone;

/**
 * This is the model class for table "t_device".
 *
 * @property string $ID
 * @property string $DEVICE_ID
 * @property string $DEVICE_NAME
 * @property string $SERIAL_NUMBER
 * @property string $CELL_ID
 * @property string $ADDRESS
 * @property string $DEPARTID
 * @property string $CREATESYSDATE
 * @property string $CREATE_TIME
 * @property string $UPDATE_TIME
 * @property string $CREATE_USER
 * @property string $UPDATE_USER
 * @property string $REMARK
 */
class Device extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 't_device';
    }

    /**
     * @inheritdoc
     */
    public $provinces;
    public $citys;
    public $countys;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['ID','DEVICE_ID','DEVICE_NAME','SERIAL_NUMBER','CELL_ID'], 'required'],
            [['ID', 'SERIAL_NUMBER'], 'string', 'max' => 50],
            [['DEVICE_ID', 'DEVICE_NAME', 'ADDRESS', 'DEPARTID'], 'string', 'max' => 100],
            [['CELL_ID', 'CREATE_USER', 'UPDATE_USER'], 'string', 'max' => 32],
            [['CREATESYSDATE', 'CREATE_TIME', 'UPDATE_TIME'], 'string', 'max' => 24],
            [['REMARK'], 'string', 'max' => 1000],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'ID' => 'ID',
            'DEVICE_ID' => '设备编号',
            'DEVICE_NAME' => '设备名称',
            'SERIAL_NUMBER' => '串号（硬件设备上）',
            'CELL_ID' => '所属小区',
            'ADDRESS' => '安装地址',
            'DEPARTID' => '注册秒兜返回的小区编号',
            'CREATESYSDATE' => '注册时间',
            'CREATE_TIME' => '创建时间',
            'UPDATE_TIME' => '更新时间',
            'CREATE_USER' => '创建人',
            'UPDATE_USER' => '更新人',
            'REMARK' => '备注',
        ];
    }
}
