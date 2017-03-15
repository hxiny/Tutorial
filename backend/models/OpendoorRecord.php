<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "t_opendoor_record".
 *
 * @property integer $ID
 * @property string $USER_ID
 * @property string $CELL_ID
 * @property string $DEVICE_ID
 * @property string $OPEN_TIME
 * @property string $OPEN_RESULT
 */
class OpendoorRecord extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 't_opendoor_record';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['ID', 'USER_ID', 'CELL_ID', 'DEVICE_ID', 'OPEN_TIME', 'OPEN_RESULT'], 'required'],
            [['ID'], 'integer'],
            [['USER_ID', 'CELL_ID', 'DEVICE_ID', 'OPEN_TIME'], 'string', 'max' => 50],
            [['OPEN_RESULT'], 'string', 'max' => 1],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'ID' => 'ID',
            'USER_ID' => '用户',
            'CELL_ID' => '小区',
            'DEVICE_ID' => '设备名称',
            'OPEN_TIME' => '开门时间',
            'OPEN_RESULT' => '开门结果',
        ];
    }
}
