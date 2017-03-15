<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "t_repair_work_notes".
 *
 * @property string $ID
 * @property string $NOTES_ID
 * @property string $PRE_REPAIR_TIME
 * @property string $REAL_REPAIR_TIME
 * @property double $REPAIR_FEE
 * @property string $REPAIR_SCHEMA_DIRECT
 * @property string $SEND_USER
 * @property string $REPAIR_USER
 * @property string $REPAIR_USER_PHONE
 * @property string $CREATE_TIME
 * @property string $OPER_TIME
 * @property string $OPER_USER
 * @property string $REMARK
 */
class TRepairWorkNotes extends \yii\db\ActiveRecord implements CanModular
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 't_repair_work_notes';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['ID', 'NOTES_ID'], 'required'],
            [['REPAIR_FEE'], 'number'],
            [['ID', 'NOTES_ID', 'REPAIR_USER', 'CREATE_TIME', 'OPER_TIME', 'OPER_USER'], 'string', 'max' => 50],
            [['PRE_REPAIR_TIME', 'REAL_REPAIR_TIME'], 'string', 'max' => 20],
            [['REPAIR_SCHEMA_DIRECT', 'REMARK'], 'string', 'max' => 255],
            [['SEND_USER'], 'string', 'max' => 30],
            [['REPAIR_USER_PHONE'], 'string', 'max' => 15],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'ID' => 'ID',
            'NOTES_ID' => '申请单单号',
            'PRE_REPAIR_TIME' => '预到场维修时间',
            'REAL_REPAIR_TIME' => '时间完成维修时间',
            'REPAIR_FEE' => '维修费用',
            'REPAIR_SCHEMA_DIRECT' => '维修方案说明',
            'SEND_USER' => '派单员',
            'REPAIR_USER' => '维修人员',
            'REPAIR_USER_PHONE' => '维修人员电话',
            'CREATE_TIME' => '工单生成时间',
            'OPER_TIME' => '操作时间',
            'OPER_USER' => '操作人员',
            'REMARK' => '备注信息',
        ];
    }

    public function getModuleName()
    {
        return 'work';
    }
    public function getNotes()
    {
        return $this->hasOne(TRepairNotes::className(), ['ID' => 'NOTES_ID']);
    }
}
