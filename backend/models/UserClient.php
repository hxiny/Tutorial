<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "t_user_client".
 *
 * @property string $ID
 * @property string $USER_ID
 * @property string $CLIENT_TYPE
 * @property string $BINDINGS_INFO
 * @property string $CELL_ID
 */
class UserClient extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 't_user_client';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['ID'], 'required'],
            [['ID', 'USER_ID', 'CELL_ID'], 'string', 'max' => 32],
            [['CLIENT_TYPE'], 'string', 'max' => 12],
            [['BINDINGS_INFO'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'ID' => 'ID',
            'USER_ID' => 'User  ID',
            'CLIENT_TYPE' => 'Client  Type',
            'BINDINGS_INFO' => 'Bindings  Info',
            'CELL_ID' => 'Cell  ID',
        ];
    }

    public function getWxInfo()
    {
        return $this->hasOne(WxUserInfo::className(), ['open_id' => 'BINDINGS_INFO']);
    }
}
