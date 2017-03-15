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
class PayProject extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 't_pay_project';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            //[['ID', 'PROJECT_ID', 'PAY_AMOUNT'], 'required'],
            [['PROJECT_ID', 'PAY_AMOUNT'], 'required'],
            [['PAY_AMOUNT','ID'], 'number'],
            //[['ID'], 'string', 'max' => 32],
            [['PROJECT_ID'], 'string', 'max' => 12],
            [['BILL_ID'], 'string', 'max' => 50],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'ID' => 'ID',
            'PROJECT_ID' => '缴费项目',
            'PAY_AMOUNT' => 'Pay  Amount',
            'BILL_ID' => 'Bill  ID',
        ];
    }
}
