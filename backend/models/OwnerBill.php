<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "t_owner_bill".
 *
 * @property string $BILL_ID
 * @property double $PAY_AMOUNT
 * @property string $PAY_START_DATE
 * @property string $PAY_END_DATE
 * @property string $PAY_STATUS
 * @property string $CREATE_TIME
 * @property string $OPER_USER
 * @property string $OPER_TIME
 * @property string $PAY_ACCOUNT
 * @property string $REMAKR
 */
class OwnerBill extends \yii\db\ActiveRecord
{

    /**
     * @const 缴费状态：未缴费
     */
    const PAY_STATUS_WAIT_PAID = '0';
    /**
     * @const 缴费状态：已缴费
     */
    const PAY_STATUS_HAS_PAID = '1';
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 't_bill';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['BILL_ID', 'CREATE_TIME'], 'required'],
            [['HOUSE_ID'], 'string', 'max' => 24],
            [['PAY_AMOUNT', 'STATUS'], 'number'],
            [['BILL_ID', 'OPER_TIME'], 'string', 'max' => 50],
            [['PAY_START_DATE', 'PAY_END_DATE', 'CREATE_TIME'], 'string', 'max' => 20],
            [['PAY_STATUS'], 'string', 'max' => 1],
            [['PAY_ACCOUNT'], 'string', 'max' => 100],
            [['REMAKR'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'BILL_ID' => '账单编号',
            'HOUSE_ID' => '所属房屋',
            'PAY_AMOUNT' => '缴费总额',
            'PAY_START_DATE' => '缴费项目开始时间',
            'PAY_END_DATE' => '缴费项目结束时间',
            'PAY_STATUS' => '缴费状态',
            'CREATE_TIME' => '生成时间',
            'PAY_USER' => '支付人员',
            'OPER_TIME' => '支付时间',
            'PAY_ACCOUNT' => '缴费人',
            'REMAKR' => '备注',
            'STATUS' => '状态',
            'PHONE' => '手机号',
            'BUILD' => '楼宇',
            'CELL' => '小区',
            'PAY_PROJECT' => '收费项目',
        ];
    }

    public function getHouse()
    {
        return $this->hasOne(House::className(), ['ID' => 'HOUSE_ID']);
    }
}
