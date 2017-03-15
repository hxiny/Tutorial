<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "t_pay_queue".
 *
 * @property integer $ID
 * @property string $ORDER_NO
 * @property string $USER_ID
 * @property integer $PAY_AMOUNT
 * @property integer $BILL_TYPE
 * @property integer $PAY_WAY_TYPE
 * @property string $PAY_TIME
 * @property string $CREATE_TIME
 * @property integer $STATUS
 * @property string $EXTRA_JSON
 * @property string $FAIL_REASON
 * @property string $MEMO
 */
class PayQueue extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 't_pay_queue';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['ORDER_NO', 'USER_ID', 'PAY_TIME'], 'required'],
            [['PAY_AMOUNT', 'BILL_TYPE', 'PAY_WAY_TYPE', 'STATUS'], 'integer'],
            [['PAY_TIME', 'CREATE_TIME'], 'safe'],
            [['ORDER_NO'], 'string', 'max' => 50],
            [['USER_ID'], 'string', 'max' => 32],
            [['EXTRA_JSON', 'FAIL_REASON', 'MEMO'], 'string', 'max' => 200],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'ID' => 'ID',
            'ORDER_NO' => 'Order  No',
            'USER_ID' => 'User  ID',
            'PAY_AMOUNT' => 'Pay  Amount',
            'BILL_TYPE' => 'Bill  Type',
            'PAY_WAY_TYPE' => 'Pay  Way  Type',
            'PAY_TIME' => 'Pay  Time',
            'CREATE_TIME' => 'Create  Time',
            'STATUS' => 'Status',
            'EXTRA_JSON' => 'Extra  Json',
            'FAIL_REASON' => 'Fail  Reason',
            'MEMO' => 'Memo',
        ];
    }
}
