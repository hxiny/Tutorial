<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "t_build".
 *
 * @property integer $ID
 * @property string $CELL_ID
 * @property string $AREA_ID
 * @property string $BUILD_NUM
 * @property string $ADDRESS
 * @property integer $STOREY_NUM
 * @property string $IS_ACCESS
 * @property integer $SORT
 * @property integer $ELEVATOR_NUM
 * @property string $CREATE_TIME
 * @property string $UPDATE_TIME
 * @property string $CREATE_USER
 * @property string $UPDATE_USER
 * @property string $REMARK
 */
class Build extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 't_build';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['CELL_ID', 'BUILD_NUM', 'STOREY_NUM'], 'required'],
            [['CELL_ID','STOREY_NUM', 'SORT', 'ELEVATOR_NUM'], 'integer'],
            [[ 'AREA_ID'], 'string', 'max' => 32],
            [['BUILD_NUM', 'CREATE_TIME', 'UPDATE_TIME'], 'string', 'max' => 20],
            [['ADDRESS'], 'string', 'max' => 10],
            [['IS_ACCESS'], 'string', 'max' => 1],
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
            'CELL_ID' => '小区编号',
            'AREA_ID' => '所属区域',
            'BUILD_NUM' => '楼房编号',
            'ADDRESS' => '楼房地址',
            'STOREY_NUM' => '层数',
            'IS_ACCESS' => '是否有门禁',
            'ELEVATOR_NUM' => '电梯数量',
            'CREATE_TIME' => '创建时间',
            'UPDATE_TIME' => '修改时间',
            'CREATE_USER' => '录入人员',
            'UPDATE_USER' => '修改人员',
            'REMARK' => '备注',
        ];
    }

    public function getArea()
    {
        return $this->hasOne(Area::className(), ['ID' => 'AREA_ID']);
    }
}
