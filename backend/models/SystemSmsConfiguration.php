<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "system_sms_configuration".
 *
 * @property integer $id
 * @property integer $company_id
 * @property integer $app_id
 * @property string $app_key
 * @property string $secret_key
 * @property string $extend
 * @property string $sms_type
 * @property string $sms_free_sign_name
 * @property string $sms_template_code
 */
class SystemSmsConfiguration extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'system_sms_configuration';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['company_id', 'configuration_name', 'app_id', 'app_key', 'secret_key', 'extend', 'sms_type', 'sms_free_sign_name', 'sms_template_code'], 'required'],
            [['company_id','type'], 'integer'],
            [['app_key', 'configuration_name', 'secret_key', 'sms_type', 'sms_free_sign_name', 'sms_template_code'], 'string', 'max' => 50],
            [['extend', 'app_id'], 'string', 'max' => 20],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'company_id' => '公司',
            'app_id' => '公众号',
            'configuration_name' => '配置名称',
            'app_key' => 'App Key',
            'secret_key' => 'Secret Key',
            'extend' => 'Extend',
            'sms_type' => 'Sms Type',
            'sms_free_sign_name' => 'Sms Free Sign Name',
            'sms_template_code' => 'Sms Template Code',
            'type' => '类型',
        ];
    }
}
