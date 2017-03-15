<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "t_user_cert".
 *
 * @property string $ID
 * @property string $USER_ID
 * @property resource $MAN_CERT
 * @property resource $HOUSE_CERT
 * @property string $MAN_CERT_PATH
 * @property string $HOUSE_CERT_PATH
 * @property string $REMARK
 */
class UserCert extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 't_user_cert';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['ID'], 'required'],
            [['MAN_CERT', 'HOUSE_CERT'], 'string'],
            [['ID'], 'string', 'max' => 32],
            [['USER_ID'], 'string', 'max' => 24],
            [['MAN_CERT_PATH', 'HOUSE_CERT_PATH'], 'string', 'max' => 50],
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
            'USER_ID' => '用户ID',
            'MAN_CERT' => '身份证件',
            'HOUSE_CERT' => '房屋相关证件',
            'MAN_CERT_PATH' => '身份证件路径',
            'HOUSE_CERT_PATH' => '房屋证件路径',
            'REMARK' => '备注信息',
        ];
    }
}
