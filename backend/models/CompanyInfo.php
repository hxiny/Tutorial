<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "t_company_info".
 *
 * @property integer $ID
 * @property string $NAME
 * @property string $ADDRESS
 * @property string $SET_DATE
 * @property string $CHARGE_MAN
 * @property string $CORPORATE
 * @property string $CREDIT_CODE
 * @property string $ENTERPRISE_TYPE
 * @property string $ORGANIZATION_CODE
 * @property string $CREATE_TIME
 * @property string $UPDATE_TIME
 * @property string $CREATE_USER
 * @property string $UPDATE_USER
 * @property string $REMARK
 */
class CompanyInfo extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 't_company_info';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['NAME', 'ADDRESS', 'CHARGE_MAN', 'CORPORATE', 'CREATE_TIME', 'UPDATE_TIME', 'CREATE_USER', 'UPDATE_USER'], 'required'],
            [['NAME'], 'string', 'max' => 100],
            [['ADDRESS'], 'string', 'max' => 150],
            [['SET_DATE', 'CREATE_TIME', 'UPDATE_TIME'], 'string', 'max' => 20],
            [['CHARGE_MAN'], 'string', 'max' => 30],
            [['CORPORATE', 'CREDIT_CODE', 'ORGANIZATION_CODE', 'CREATE_USER', 'UPDATE_USER'], 'string', 'max' => 50],
            [['ENTERPRISE_TYPE'], 'string', 'max' => 12],
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
            'NAME' => '物业名称',
            'ADDRESS' => '详细地址',
            'SET_DATE' => '成立日期',
            'CHARGE_MAN' => '负责人',
            'CORPORATE' => '法人',
            'CREDIT_CODE' => '统一信用代号',
            'ENTERPRISE_TYPE' => '企业类型',
            'ORGANIZATION_CODE' => '组织机构代码',
            'CREATE_TIME' => '创建时间',
            'UPDATE_TIME' => '修改时间',
            'CREATE_USER' => '录入人员',
            'UPDATE_USER' => '修改人员',
            'REMARK' => '备注',
        ];
    }
}
