<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "t_cells".
 *
 * @property integer $ID
 * @property string $PROPERTY_ID
 * @property string $NAME
 * @property string $TYPE
 * @property string $ADDRESS
 * @property string $START_WORK_DATE
 * @property string $COMPLE_WORK_DATE
 * @property integer $STAGE
 * @property integer $TOTAL_HOUSE
 * @property integer $TOTAL_BUILD
 * @property double $BUILD_AREA
 * @property double $COVER_AREA
 * @property double $HOUSE_AREA
 * @property double $STORE_AREA
 * @property double $OFFICE_AREA
 * @property double $CLUB_AREA
 * @property double $GREEN_AREA
 * @property integer $PACK_NUM
 * @property integer $ENTER_NUM
 * @property integer $EXIT_NUM
 * @property double $LONGITUDE
 * @property resource $PLANE
 * @property string $CREATE_TIME
 * @property string $UPDATE_TIME
 * @property string $CREATE_USER
 * @property string $UPDATE_USER
 * @property string $REMARK
 * @property double $LATITUDE
 */
class Cells extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 't_cells';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['PROPERTY_ID', 'NAME', 'TYPE', 'ADDRESS', 'CREATE_TIME', 'UPDATE_TIME', 'CREATE_USER', 'UPDATE_USER'], 'required'],
            [['STAGE', 'TOTAL_HOUSE', 'TOTAL_BUILD', 'PACK_NUM', 'ENTER_NUM', 'EXIT_NUM'], 'integer'],
            [['BUILD_AREA', 'COVER_AREA', 'HOUSE_AREA', 'STORE_AREA', 'OFFICE_AREA', 'CLUB_AREA', 'GREEN_AREA', 'LONGITUDE', 'LATITUDE'], 'number'],
            [['PLANE'], 'string'],
            [['PROPERTY_ID'], 'string', 'max' => 32],
            [['NAME'], 'string', 'max' => 100],
            [['TYPE', 'START_WORK_DATE', 'COMPLE_WORK_DATE', 'CREATE_TIME', 'UPDATE_TIME'], 'string', 'max' => 20],
            [['ADDRESS'], 'string', 'max' => 150],
            [['CREATE_USER', 'UPDATE_USER'], 'string', 'max' => 50],
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
            'PROPERTY_ID' => '所属公司',
            'NAME' => '小区名称',
            'TYPE' => '小区类型',
            'ADDRESS' => '坐落位置',
            'START_WORK_DATE' => '开工时间',
            'COMPLE_WORK_DATE' => '竣工时间',
            'STAGE' => '期数',
            'TOTAL_HOUSE' => '总户数',
            'TOTAL_BUILD' => '建筑栋数',
            'BUILD_AREA' => '建筑面积',
            'COVER_AREA' => '占地面积',
            'HOUSE_AREA' => '住宅面积',
            'STORE_AREA' => '商用面积',
            'OFFICE_AREA' => '写字楼面积',
            'CLUB_AREA' => '会所面积',
            'GREEN_AREA' => '绿化面积',
            'PACK_NUM' => '车位个数',
            'ENTER_NUM' => '入口个数',
            'EXIT_NUM' => '出口个数',
            'LONGITUDE' => '经度',
            'PLANE' => '小区平面图',
            'CREATE_TIME' => '创建时间',
            'UPDATE_TIME' => '修改时间',
            'CREATE_USER' => '录入人员',
            'UPDATE_USER' => '修改人员',
            'REMARK' => '备注',
            'LATITUDE' => '纬度',
        ];
    }
}
