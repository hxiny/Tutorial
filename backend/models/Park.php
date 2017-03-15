<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "t_park".
 *
 * @property string $ID
 * @property string $PARK_NUM
 * @property string $CELL_ID
 * @property string $AREA_ID
 * @property string $POSITION_TYPE
 * @property string $PARK_TYPE
 * @property string $PARK_STATUS
 * @property string $PARK_AREA
 * @property string $MANAGE_USER
 * @property string $CREATE_TIME
 * @property string $UPDATE_TIME
 * @property string $CREATE_USER
 * @property string $UPDATE_USER
 * @property string $REMARK
 */
class Park extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 't_park';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['ID', 'CELL_ID'], 'required'],
            [['ID', 'MANAGE_USER', 'CREATE_USER', 'UPDATE_USER'], 'string', 'max' => 50],
            [['PARK_NUM', 'PARK_AREA', 'CREATE_TIME', 'UPDATE_TIME'], 'string', 'max' => 20],
            [['CELL_ID', 'AREA_ID'], 'string', 'max' => 32],
            [['POSITION_TYPE', 'PARK_TYPE'], 'string', 'max' => 12],
            [['PARK_STATUS'], 'string', 'max' => 1],
            [['REMARK'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'ID' => 'ID',
            'PARK_NUM' => 'Park  Num',
            'CELL_ID' => 'Cell  ID',
            'AREA_ID' => 'Area  ID',
            'POSITION_TYPE' => 'Position  Type',
            'PARK_TYPE' => 'Park  Type',
            'PARK_STATUS' => 'Park  Status',
            'PARK_AREA' => 'Park  Area',
            'MANAGE_USER' => 'Manage  User',
            'CREATE_TIME' => 'Create  Time',
            'UPDATE_TIME' => 'Update  Time',
            'CREATE_USER' => 'Create  User',
            'UPDATE_USER' => 'Update  User',
            'REMARK' => 'Remark',
        ];
    }
}
