<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "t_repair_audit".
 *
 * @property string $ID
 * @property string $NOTES_ID
 * @property string $AUDIT_TIME
 * @property string $AUDIT_USER
 * @property string $AUDIT_RESULT
 * @property string $AUDIT_OPTION
 * @property string $REMARK
 */
class TRepairAudit extends \yii\db\ActiveRecord implements  CanModular
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 't_repair_audit';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['ID', 'NOTES_ID', 'AUDIT_TIME', 'AUDIT_USER', 'AUDIT_RESULT'], 'required'],
            [['ID'], 'string', 'max' => 32],
            [['NOTES_ID', 'AUDIT_USER'], 'string', 'max' => 50],
            [['AUDIT_TIME'], 'string', 'max' => 20],
            [['AUDIT_RESULT'], 'string', 'max' => 12],
            [['AUDIT_OPTION', 'REMARK'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'ID' => 'ID',
            'NOTES_ID' => '报修单ID',
            'AUDIT_TIME' => '审核时间',
            'AUDIT_USER' => '审核人',
            'AUDIT_RESULT' => '审核结果',
            'AUDIT_OPTION' => '审核意见',
            'REMARK' => '备注信息',
        ];
    }

    public function getModuleName()
    {
        return 'audit';
    }

    public function getNotes()
    {

        return $this->hasOne(TRepairNotes::className(), ['ID' => 'NOTES_ID']);
    }
}
