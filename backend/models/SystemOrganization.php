<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "system_organization".
 *
 * @property integer $organization_id
 * @property string $organization_name
 */
class SystemOrganization extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'system_organization';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['organization_name'], 'required'],
            [['organization_name'], 'string', 'max' => 50],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'organization_id' => '机构ID',
            'organization_name' => '机构名称',
        ];
    }
}
