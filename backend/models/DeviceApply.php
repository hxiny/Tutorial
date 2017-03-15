<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "t_device_apply".
 *
 * @property integer $ID
 * @property string $USER_ID
 * @property string $CELL_ID
 * @property string $DEVICE_ID
 * @property string $APPLY_TIME
 * @property string $AUDIT_STATUS
 */
class DeviceApply extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 't_device_apply';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['ID', 'USER_ID', 'CELL_ID', 'DEVICE_ID', 'VALIDITY', 'APPLY_TIME', 'AUDIT_STATUS'], 'required'],
            [['ID', 'VALIDITY'], 'integer'],
            [['USER_ID', 'CELL_ID', 'DEVICE_ID', 'APPLY_TIME'], 'string', 'max' => 50],
            [['AUDIT_STATUS'], 'string', 'max' => 1],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'ID' => 'ID',
            'USER_ID' => '申请人',
            'CELL_ID' => '所属小区',
            'DEVICE_ID' => '设备名称',
            'VALIDITY' => '钥匙有效时间',
            'APPLY_TIME' => '申请时间',
            'AUDIT_STATUS' => '审核状态',
        ];
    }
    public function getUser()
    {
        return $this->hasOne(User::className(),['USER_ID'=>'USER_ID']);
    }

    public function getCell()
    {
        return $this->hasOne(Cells::className(), ['ID' => 'CELL_ID']);
    }
}
