<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "t_user".
 *
 * @property string $USER_ID
 * @property string $NICKNAME
 * @property string $HEADIMGURL
 * @property string $STATUS
 * @property string $PASSWORD
 * @property string $SEX
 * @property string $PHONE
 * @property string $NEXT_KIN_PHONE
 * @property integer $QQ
 * @property string $EMAIL
 * @property string $ADDR
 * @property string $WORK_UNIT
 * @property string $CREATE_TIME
 * @property string $UPDATE_TIME
 * @property string $CREATE_USER
 * @property string $UPDATE_USER
 * @property string $REMARK
 */
class User extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 't_user';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['USER_ID'], 'required'],
            [['HEADIMGURL'], 'string'],
            [['QQ'], 'integer'],
            [['USER_ID'], 'string', 'max' => 32],
            [['NICKNAME', 'STATUS', 'PASSWORD', 'CREATE_USER', 'UPDATE_USER'], 'string', 'max' => 50],
            [['SEX'], 'string', 'max' => 1],
            [['PHONE', 'NEXT_KIN_PHONE'], 'string', 'max' => 15],
            [['EMAIL'], 'string', 'max' => 25],
            [['ADDR', 'WORK_UNIT'], 'string', 'max' => 150],
            [['CREATE_TIME', 'UPDATE_TIME'], 'string', 'max' => 20],
            [['REMARK'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'USER_ID' => '用户ID',
            'NICKNAME' => '昵称',
            'HEADIMGURL' => '图片地址',
            'STATUS' => '状态',
            'PASSWORD' => '密码',
            'SEX' => '性别',
            'PHONE' => '手机',
            'NEXT_KIN_PHONE' => '近亲电话',
            'QQ' => 'QQ号码',
            'EMAIL' => '邮箱',
            'ADDR' => '地址',
            'WORK_UNIT' => '工作单位',
            'CREATE_TIME' => '创建时间',
            'UPDATE_TIME' => '更新时间',
            'CREATE_USER' => '添加的管理员',
            'UPDATE_USER' => '更新的管理员',
            'REMARK' => '备注信息',
        ];
    }

    public function getUserClient()
    {
        return $this->hasOne(UserClient::className(), ['USER_ID' => 'USER_ID']);
    }

    public function getUserCells()
    {
        return $this->hasMany(UserCell::className(), ['USER_ID' => 'USER_ID']);
    }
}
