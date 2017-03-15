<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "t_area".
 *
 * @property string $ID
 * @property string $CELL_ID
 * @property string $AREA_NAME
 * @property string $CREATE_TIME
 * @property string $UPDATE_TIME
 * @property string $CREATE_USER
 * @property string $UPDATE_USER
 * @property string $REMARK
 */
class Area extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 't_area';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['ID', 'AREA_NAME'], 'required'],
            [['ID'], 'string', 'max' => 32],
            [['CELL_ID', 'AREA_NAME', 'CREATE_USER', 'UPDATE_USER'], 'string', 'max' => 50],
            [['CREATE_TIME', 'UPDATE_TIME'], 'string', 'max' => 20],
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
            'CELL_ID' => '所属小区',
            'AREA_NAME' => '区域名称',
            'CREATE_TIME' => 'Create  Time',
            'UPDATE_TIME' => 'Update  Time',
            'CREATE_USER' => 'Create  User',
            'UPDATE_USER' => 'Update  User',
            'REMARK' => 'Remark',
        ];
    }
}
