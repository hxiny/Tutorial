<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "t_advertis".
 *
 * @property string $ID
 * @property string $PIC_IMG
 * @property string $ADVERTIS_URL
 * @property string $ADVERTIS_TYPE
 * @property string $ADVERTIS_INTRODUCT
 * @property string $ADVERTIS_TITLE
 * @property string $ADVERTIS_START_DATE
 * @property string $ADVERTIS_END_DATE
 * @property string $STATUS
 * @property string $REMARK
 */
class Advertis extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 't_advertis';
    }

    /**
     * @inheritdoc
     */
    public $CELL_ID;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            //[['ID'], 'required'],
            [['ID', 'ADVERTIS_TITLE', 'ADVERTIS_START_DATE', 'ADVERTIS_END_DATE', 'STATUS', 'REMARK'], 'string', 'max' => 50],
            [['PIC_IMG', 'ADVERTIS_URL', 'ADVERTIS_INTRODUCT'], 'string', 'max' => 200],
            [['ADVERTIS_TYPE'], 'string', 'max' => 10],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'ID' => 'ID',
            'PIC_IMG' => '图片地址',
            'ADVERTIS_URL' => '广告地址',
            'ADVERTIS_TYPE' => '广告类型',
            'ADVERTIS_INTRODUCT' => '广告简介',
            'ADVERTIS_TITLE' => '广告标题',
            'ADVERTIS_START_DATE' => '广告开始时间',
            'ADVERTIS_END_DATE' => '广告结束时间',
            'STATUS' => '是否投放',
            'REMARK' => '备注',
        ];
    }
}
