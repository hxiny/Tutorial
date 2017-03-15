<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "t_sms_history".
 *
 * @property integer $id
 * @property string $app_id
 * @property string $phone
 * @property integer $type
 * @property string $send_time
 */
class SmsHistory extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 't_sms_history';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['app_id', 'phone', 'type', 'send_time'], 'required'],
            [['type'], 'integer'],
            [['app_id', 'phone', 'send_time'], 'string', 'max' => 50],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'app_id' => '公众号',
            'phone' => '接收短信的号码',
            'type' => '短信类型',
            'send_time' => '发送时间',
        ];
    }
}
