<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "t_repair_evidence".
 *
 * @property string $ID
 * @property string $REPAIR_NOTES_ID
 * @property string $WORK_NOTES_ID
 * @property string $DEAL_BEFORE_PHOTO
 * @property string $DEAL_AFTER_PHOTO
 * @property string $REMARK
 */
class TRepairEvidence extends \yii\db\ActiveRecord implements CanModular
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 't_repair_evidence';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['ID', 'REPAIR_NOTES_ID', 'WORK_NOTES_ID'], 'required'],
            [['ID', 'WORK_NOTES_ID'], 'string', 'max' => 32],
            [['REPAIR_NOTES_ID'], 'string', 'max' => 50],
            [['DEAL_BEFORE_PHOTO', 'DEAL_AFTER_PHOTO'], 'string', 'max' => 100],
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
            'REPAIR_NOTES_ID' => '报修申请单编号',
            'WORK_NOTES_ID' => '工单编号',
            'DEAL_BEFORE_PHOTO' => '未报修证据',
            'DEAL_AFTER_PHOTO' => '报修照片',
            'REMARK' => '备注信息',
        ];
    }

    public function getModuleName()
    {
        return 'evidence';
    }
    public function getNotes()
    {
        return $this->hasOne(TRepairNotes::className(), ['ID' => 'REPAIR_NOTES_ID']);
    }
}
