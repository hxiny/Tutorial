<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "t_repair_notes".
 *
 * @property string $ID
 * @property string $USER_ID
 * @property string $REPAIR_TIME
 * @property string $REPAIR_PROJECT
 * @property string $REPAIR_PROBLEM
 * @property string $REPAIR_CONTENT
 * @property string $REPAIR_TYPE
 * @property string $REPAIR_IMG
 * @property integer $CELL_ID
 * @property string $BUILD_NUM
 * @property string $HOUSE_CODE
 * @property string $PHONE
 * @property string $EXPECT_TIME
 * @property string $STATUS
 * @property string $CREATE_TIME
 * @property string $CREATE_USER
 * @property string $UPDATE_TIME
 * @property string $UPDATE_USER
 * @property string $REMARK
 */
class TRepairNotes extends \yii\db\ActiveRecord implements CanModular
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 't_repair_notes';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['ID', 'USER_ID', 'REPAIR_TIME', 'REPAIR_CONTENT'], 'required'],
            [['CELL_ID'], 'integer'],
            [['ID', 'HOUSE_CODE', 'CREATE_USER', 'UPDATE_USER'], 'string', 'max' => 50],
            [['USER_ID', 'BUILD_NUM', 'UPDATE_TIME'], 'string', 'max' => 32],
            [['REPAIR_TIME'], 'string', 'max' => 25],
            [['REPAIR_PROJECT', 'REPAIR_TYPE'], 'string', 'max' => 12],
            [['REPAIR_PROBLEM'], 'string', 'max' => 100],
            [['REPAIR_CONTENT', 'REMARK'], 'string', 'max' => 255],
            [['REPAIR_IMG'], 'string', 'max' => 1200],
            [['PHONE'], 'string', 'max' => 15],
            [['EXPECT_TIME', 'CREATE_TIME'], 'string', 'max' => 20],
            [['STATUS'], 'string', 'max' => 1],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'ID' => 'ID',
            'USER_ID' => '报修人',
            'REPAIR_TIME' => '报修时间',
            'REPAIR_PROJECT' => '报修项目类型',
            'REPAIR_PROBLEM' => '报修问题',
            'REPAIR_CONTENT' => '报修内容',
            'REPAIR_TYPE' => '报修类型',
            'REPAIR_IMG' => '报修图片',
            'CELL_ID' => '所属小区',
            'BUILD_NUM' => '所属小区几号楼',
            'HOUSE_CODE' => '单元信息',
            'PHONE' => '联系电话',
            'EXPECT_TIME' => '期望来修的时间',
            'STATUS' => '状态',
            'CREATE_TIME' => '创建时间',
            'CREATE_USER' => '创建人',
            'UPDATE_TIME' => '修改时间',
            'UPDATE_USER' => '修改人员',
            'REMARK' => '备注信息',
        ];
    }
    public function getModuleName()
    {
        return 'notes';
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
