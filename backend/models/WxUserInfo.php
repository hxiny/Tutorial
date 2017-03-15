<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "wx_user_info".
 *
 * @property string $open_id
 * @property string $nickname
 * @property integer $sex
 * @property string $language
 * @property string $city
 * @property string $province
 * @property string $country
 * @property string $headimgurl
 * @property string $update_time
 */
class WxUserInfo extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'wx_user_info';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['open_id'], 'required'],
            [['sex'], 'integer'],
            [['update_time'], 'safe'],
            [['open_id'], 'string', 'max' => 32],
            [['nickname'], 'string', 'max' => 50],
            [['language', 'city', 'province', 'country'], 'string', 'max' => 45],
            [['headimgurl'], 'string', 'max' => 200],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'open_id' => 'Open ID',
            'nickname' => '昵称',
            'sex' => '性别',
            'language' => 'Language',
            'city' => 'City',
            'province' => 'Province',
            'country' => 'Country',
            'headimgurl' => 'Headimgurl',
            'update_time' => 'Update Time',
        ];
    }
}
