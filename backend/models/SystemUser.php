<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "user".
 *
 * @property integer $id
 * @property string $username
 * @property string $auth_key
 * @property string $password_hash
 * @property string $password_reset_token
 * @property string $email
 * @property integer $organization_id
 * @property integer $role_id
 * @property integer $gender
 * @property string $phone
 * @property string $real_name
 * @property integer $status
 * @property integer $created_at
 * @property integer $updated_at
 */
class SystemUser extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'user';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['username', 'email', 'gender', 'phone', 'real_name'], 'required'],
            [['phone', 'status', 'created_at', 'updated_at'], 'integer'],
            [['username', 'auth_key'], 'string', 'max' => 32],
            [['password_hash', 'password_reset_token', 'email'], 'string', 'max' => 256],
            [['real_name'], 'string', 'max' => 50],
            ['email', 'email'],
            ['username', 'unique']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'username' => '用户名',
            'auth_key' => 'Auth Key',
            'password_hash' => '密码',
            'password_reset_token' => 'Password Reset Token',
            'email' => '邮箱',
            'gender' => '性别',
            'phone' => '电话号码',
            'real_name' => '真实姓名',
            'status' => 'Status',
            'created_at' => '添加时间',
            'updated_at' => '更改时间',
        ];
    }
}
