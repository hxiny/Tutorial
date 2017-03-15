<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "t_pay_formula".
 *
 * @property integer $formula_id
 * @property string $formula_name
 * @property string $formula_type
 * @property string $formula_text
 */
class PayFormula extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 't_pay_formula';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['formula_name'], 'required'],
            [['formula_name'], 'string', 'max' => 50],
            [['formula_type', 'formula_text'], 'string', 'max' => 200],
        ];
    }

    /**
     * @inheritdoc
     */
    public $parameters;
    public $symbol;

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'formula_id' => 'Formula ID',
            'formula_name' => '公式名称',
            'formula_type' => '计算公式',
            'formula_text' => '中文公式',
        ];
    }
}
