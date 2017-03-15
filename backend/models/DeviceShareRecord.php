<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "t_device_share_record".
 *
 * @property integer $ID
 * @property string $USER_ID
 * @property string $CELL_ID
 * @property string $SHARE_TIME
 * @property string $OPEN_TIME
 * @property string $SHARE_NAME
 * @property string $SHARE_PHONE
 */
class DeviceShareRecord extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 't_device_share_record';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['ID'], 'required'],
            [['ID'], 'integer'],
            [['USER_ID', 'CELL_ID'], 'string', 'max' => 32],
            [['SHARE_TIME', 'OPEN_TIME', 'SHARE_NAME', 'SHARE_PHONE'], 'string', 'max' => 25],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'ID' => 'ID',
            'USER_ID' => 'User  ID',
            'CELL_ID' => 'Cell  ID',
            'SHARE_TIME' => 'Share  Time',
            'OPEN_TIME' => 'Open  Time',
            'SHARE_NAME' => 'Share  Name',
            'SHARE_PHONE' => 'Share  Phone',
        ];
    }
}
