<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "t_sms_formula_data".
 *
 * @property integer $id
 * @property string $variable_name
 * @property string $variable
 * @property string $query_table
 * @property string $query_column
 */
class SmsFormulaData extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 't_sms_formula_data';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['variable_name', 'variable', 'query_table', 'query_column'], 'required'],
            [['variable_name', 'variable', 'query_table', 'query_column'], 'string', 'max' => 50],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'variable_name' => '变量名称',
            'variable' => '变量',
            'query_table' => '查询的表',
            'query_column' => '查询的字段',
        ];
    }
}
