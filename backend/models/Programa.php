<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "t_programa".
 *
 * @property integer $programa_id
 * @property string $programa_name
 * @property integer $programa_type
 * @property integer $order
 * @property integer $is_show
 */
class Programa extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 't_programa';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['programa_name', 'programa_type', 'order', 'is_show'], 'required'],
            [['programa_type', 'order', 'is_show', 'cell_id'], 'integer'],
            [['programa_name'], 'string', 'max' => 50],
        ];
    }
    /**
     * @inheritdoc
     */
    public $content;
    public $colum;

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'programa_id' => '栏目编号',
            'programa_name' => '栏目名称',
            'programa_type' => '栏目类型',
            'cell_id' => '小区',
            'order' => '排序',
            'is_show' => '是否显示',
        ];
    }
}
