<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "t_pay_project".
 *
 * @property string $ID
 * @property string $PROJECT_ID
 * @property double $PAY_AMOUNT
 * @property string $BILL_ID
 */
class PayRecord extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 't_pay_record';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            //[['ID', 'PROJECT_ID', 'PAY_AMOUNT'], 'required'],
            [['BILL_ID', 'PAY_USER', 'PAY_AMOUNT'], 'required'],
            [['PAY_AMOUNT','ID', 'PAY_TYPE', 'BILL_TYPE'], 'number'],
            [['BILL_ID', 'PAY_USER'], 'string', 'max' => 50],
            [['PAY_ACCOUNT'], 'string', 'max' => 100],
            [['PAY_UNIONPAY'], 'string', 'max' => 12],
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
            'BILL_ID' => '账单编号',
            'PAY_AMOUNT' => '缴费金额',
            'PAY_TYPE' => '缴费方式',
            'REMARK' => '备注',
        ];
    }
}
