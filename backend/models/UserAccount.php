<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "t_user_account".
 *
 * @property string $ID
 * @property string $USER_ID
 * @property string $ACCOUNT_TYPE
 * @property integer $ACCOUNT_OVER
 * @property integer $ACCOUNT_INTEGRAL
 */
class UserAccount extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 't_user_account';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['ID', 'ACCOUNT_TYPE'], 'required'],
            [['ACCOUNT_OVER', 'ACCOUNT_INTEGRAL'], 'integer'],
            [['ID', 'USER_ID'], 'string', 'max' => 32],
            [['ACCOUNT_TYPE'], 'string', 'max' => 12],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'ID' => 'ID',
            'USER_ID' => '用户',
            'ACCOUNT_TYPE' => '账户类型',
            'ACCOUNT_OVER' => '账户余额',
            'ACCOUNT_INTEGRAL' => '账户积分',
        ];
    }
}
