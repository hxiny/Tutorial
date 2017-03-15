<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "t_public_module".
 *
 * @property string $ID
 * @property string $MODULE_NAME
 * @property string $MODULE_URL
 * @property string $PIC_NAME
 * @property integer $SORT
 * @property string $REMARK
 */
class SystemMenu extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 't_public_module';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['ID'], 'required'],
            [['SORT'], 'integer'],
            [['ID', 'MODULE_NAME'], 'string', 'max' => 32],
            [['MODULE_URL'], 'string', 'max' => 100],
            [['PIC_NAME'], 'string', 'max' => 50],
            [['REMARK'], 'string', 'max' => 1000],
            ['ID','unique'],
        ];
    }

    /**
     * @inheritdoc
     */
    public $CELL_ID;

    /**
     * @inheritdoc
     */
    public function getCells()
    {
        return $this->hasMany(PublicModuleCell::className(), ['MODULE_ID' => 'ID']);
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'ID' => 'ID(格式为id_xxx)',
            'MODULE_NAME' => '模块名称',
            'MODULE_URL' => '模块地址',
            'PIC_NAME' => '图片名称',
            'SORT' => '排序',
            'REMARK' => '备注',
        ];
    }
}
