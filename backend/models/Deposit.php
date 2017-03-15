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
class Deposit extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 't_deposit';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['HOUSE_ID', 'USER_ID', 'AMOUNT'], 'required'],
            [['AMOUNT'], 'number'],
            [['UPDATE_TIME', 'CREATE_TIME'], 'string', 'max' => 20],
            [['USER_ID'], 'string', 'max' => 32],
            [['UPDATE_USER', 'CREATE_USER'], 'string', 'max' => 50],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            //'CELL_ID' => '小区',
            //'BUILD_ID' => '楼宇',
            'HOUSE_ID' => '所属房屋',
            'USER_ID' => '用户',
            'AMOUNT' => '预存款增加',
            'UPDATE_TIME' => '更新时间',
            'CREATE_TIME' => '创建时间',
            'CREATE_USER' => '创建用户',
            'UPDATE_USER' => '更新用户',
        ];
    }

}

