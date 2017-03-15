<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "t_park_link".
 *
 * @property string $ID
 * @property string $PARK_ID
 * @property string $LINK_MAN
 * @property string $LINK_PHONE
 * @property string $CELL_ID
 * @property integer $BUILD_ID
 * @property integer $HOUSE_ID
 * @property string $REMARK
 */
class ParkLink extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 't_park_link';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['ID', 'PARK_ID', 'LINK_MAN'], 'required'],
            [['BUILD_ID', 'HOUSE_ID'], 'integer'],
            [['ID', 'PARK_ID', 'CELL_ID'], 'string', 'max' => 32],
            [['LINK_MAN', 'LINK_PHONE'], 'string', 'max' => 50],
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
            'PARK_ID' => 'Park  ID',
            'LINK_MAN' => 'Link  Man',
            'LINK_PHONE' => 'Link  Phone',
            'CELL_ID' => 'Cell  ID',
            'BUILD_ID' => 'Build  ID',
            'HOUSE_ID' => 'House  ID',
            'REMARK' => 'Remark',
        ];
    }
}
