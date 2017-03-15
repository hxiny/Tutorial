<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "t_user_auth".
 *
 * @property string $ID
 * @property string $AUTH_USER
 * @property string $CELL_ID
 * @property string $USER_NAME
 * @property string $CERT_ID
 * @property string $CERT_IMG
 * @property string $AUTH_FLOW
 * @property string $AUTH_STATUS
 * @property string $AUTH_LIMIT
 * @property string $REMARK
 */
class UserAuth extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 't_user_auth';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['ID', 'AUTH_USER', 'CELL_ID'], 'required'],
            [['CERT_IMG'], 'string'],
            [['ID'], 'string', 'max' => 32],
            [['AUTH_USER', 'CELL_ID', 'USER_NAME', 'CERT_ID', 'AUTH_STATUS'], 'string', 'max' => 50],
            [['AUTH_FLOW'], 'string', 'max' => 1],
            [['AUTH_LIMIT'], 'string', 'max' => 20],
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
            'AUTH_USER' => '需要认证用户ID',
            'CELL_ID' => '小区编号',
            'USER_NAME' => '姓名',
            'CERT_ID' => '证件号码',
            'CERT_IMG' => '证件照片',
            'AUTH_FLOW' => '认证流程',
            'AUTH_STATUS' => '认证状态',
            'AUTH_LIMIT' => '认证期限',
            'REMARK' => '备注时间',
        ];
    }

    /**
     * relation 定义跟 t_user表的关联关系
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['USER_ID' => 'AUTH_USER']);
    }

    /**
     * relation 身份证件信息 t_user_cert
     * @return \yii\db\ActiveQuery
     */
    public function getUserCert()
    {
        return $this->hasOne(UserCert::className(), ['USER_ID' => 'AUTH_USER']);
    }

    public function getCell()
    {
        return $this->hasOne(Cells::className(), ['ID' => 'CELL_ID']);
    }
//    public function getUserClient()
//    {
//        return $this->hasOne(UserClient::className(), ['USER_ID' => 'USER_ID']);
//    }
}
