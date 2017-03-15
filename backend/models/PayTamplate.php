<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "t_pay_tamplate".
 *
 * @property integer $tamplate_id
 * @property string $tamplate_name
 * @property integer $cell_id
 * @property integer $build_id
 * @property integer $accuracy
 * @property string $formula_types
 * @property double $unit_cost
 * @property integer $period
 */
class PayTamplate extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 't_pay_tamplate';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['tamplate_name', 'cell_id', 'build_id', 'accuracy', 'formula_types', 'unit_cost', 'period'], 'required'],
            [['cell_id', 'build_id', 'accuracy', 'period'], 'integer'],
            [['unit_cost'], 'number'],
            [['tamplate_name'], 'string', 'max' => 50],
            [['formula_types'], 'string', 'max' => 200],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'tamplate_id' => '模板ID',
            'tamplate_name' => '模板名称',
            'cell_id' => '小区',
            'build_id' => '楼房',
            'accuracy' => '计费精度',
            'formula_types' => '收费公式',
            'unit_cost' => '单价',
            'period' => '计费周期(月)',
        ];
    }
}
