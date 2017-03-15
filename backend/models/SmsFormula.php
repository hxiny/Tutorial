<?php

namespace app\models;

use Yii;
use app\models\SmsFormulaData;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "t_sms_formula".
 *
 * @property integer $id
 * @property integer $cell_id
 * @property integer $formula_name
 * @property integer $variable_set
 */
class SmsFormula extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 't_sms_formula';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['cell_id', 'sms_configuration_id', 'formula_name', 'variable_set'], 'required'],
            [['cell_id', 'sms_configuration_id'], 'integer'],
            [['formula_name', 'variable_set'], 'string', 'max' => 50],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'sms_configuration_id' => '短信机',
            'cell_id' => '小区',
            'formula_name' => '模板名称',
            'variable_set' => '模板变量集',
        ];
    }

    public function variableSet($variableSet){
        $arr = explode(',', $variableSet);
        $smsFormulaData = SmsFormulaData::find() -> where(['id' => $arr]) -> asArray() -> all();
        $variableSetArray = ArrayHelper::map($smsFormulaData, 'id', 'variable_name');
        $nameStr = implode(',', $variableSetArray);
        return $nameStr;
    }
}
