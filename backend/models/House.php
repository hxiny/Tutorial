<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "t_house".
 *
 * @property integer $ID
 * @property integer $BUILD_ID
 * @property integer $STOREY
 * @property integer $TOTAL_STOREY
 * @property string $HOUSE_CODE
 * @property string $HOUSE_TYPE
 * @property string $HOUSE_AREA
 * @property string $DEVICE_ID
 * @property string $POOL_AREA
 * @property string $IS_DOUBLE_DECK
 * @property string $HOUSE_HEIGHT
 * @property string $ORIENTATION
 * @property integer $ROOM_NUM
 * @property integer $HALL_NUM
 * @property integer $BALCONY_NUM
 * @property integer $KITCHEN_NUM
 * @property integer $BATHROOM_NUM
 * @property integer $SORT
 * @property string $CREATE_TIME
 * @property string $UPDATE_TIME
 * @property string $CREATE_USER
 * @property string $UPDATE_USER
 * @property string $REMARK
 */
class House extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 't_house';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['BUILD_ID', 'STOREY', 'TOTAL_STOREY', 'HOUSE_CODE', 'HOUSE_TYPE', 'HOUSE_AREA', 'CREATE_TIME', 'UPDATE_TIME', 'CREATE_USER', 'UPDATE_USER'], 'required'],
            [['BUILD_ID', 'STOREY', 'TOTAL_STOREY', 'ROOM_NUM', 'HALL_NUM', 'BALCONY_NUM', 'KITCHEN_NUM', 'BATHROOM_NUM', 'SORT'], 'integer'],
            [['HOUSE_CODE', 'HOUSE_AREA', 'POOL_AREA', 'HOUSE_HEIGHT', 'CREATE_USER', 'UPDATE_USER'], 'string', 'max' => 50],
            [['HOUSE_TYPE'], 'string', 'max' => 12],
            [['DEVICE_ID'], 'string', 'max' => 32],
            [['IS_DOUBLE_DECK'], 'string', 'max' => 1],
            [['ORIENTATION', 'CREATE_TIME', 'UPDATE_TIME'], 'string', 'max' => 20],
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
            'BUILD_ID' => '所属楼宇',
            'STOREY' => '所在楼层',
            'HOUSE_CODE' => '房屋编号',
            'HOUSE_TYPE' => '房屋类型',
            'HOUSE_AREA' => '房屋面积',
            'DEVICE_ID' => '楼层设备信息编号',
            'POOL_AREA' => '公摊面积',
            'IS_DOUBLE_DECK' => '是否楼中楼',
            'HOUSE_HEIGHT' => '房屋高度',
            'ORIENTATION' => '朝向',
            'ROOM_NUM' => '卧室个数',
            'HALL_NUM' => '大厅个数',
            'BALCONY_NUM' => '阳台个数',
            'KITCHEN_NUM' => '厨房个数',
            'BATHROOM_NUM' => '卫生间个数',
            'CREATE_TIME' => '创建时间',
            'UPDATE_TIME' => '修改时间',
            'CREATE_USER' => '录入人员',
            'UPDATE_USER' => '修改人员',
            'REMARK' => '备注',
        ];
    }

    public function getBuild()
    {
        return $this->hasOne(Build::className(), ['ID' => 'BUILD_ID']);
    }
}
