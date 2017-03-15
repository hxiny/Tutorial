<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "region".
 *
 * @property integer $region_id
 * @property string $region_name
 * @property string $region_code
 * @property integer $level_id
 * @property integer $father_id
 * @property integer $sort
 * @property integer $dr
 */
class Region extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'region';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['level_id', 'father_id', 'sort', 'dr'], 'integer'],
            [['region_name', 'region_code'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'region_id' => 'Region ID',
            'region_name' => 'Region Name',
            'region_code' => 'Region Code',
            'level_id' => 'Level ID',
            'father_id' => 'Father ID',
            'sort' => 'Sort',
            'dr' => 'Dr',
        ];
    }
}
