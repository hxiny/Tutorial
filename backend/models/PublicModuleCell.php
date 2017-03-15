<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "t_public_module_cell".
 *
 * @property string $ID
 * @property string $MODULE_ID
 * @property string $CELL_ID
 * @property string $STATUS
 */
class PublicModuleCell extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 't_public_module_cell';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['MODULE_ID', 'CELL_ID'], 'string', 'max' => 32],
            [['STATUS'], 'string', 'max' => 1],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'ID' => 'ID',
            'MODULE_ID' => 'Module  ID',
            'CELL_ID' => 'Cell  ID',
            'STATUS' => 'Status',
        ];
    }
}
