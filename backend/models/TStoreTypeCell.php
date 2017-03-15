<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "t_store_type_cell".
 *
 * @property string $ID
 * @property string $STORE_TYPE_ID
 * @property string $CELL_ID
 * @property string $STATUS
 */
class TStoreTypeCell extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 't_store_type_cell';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['ID'], 'required'],
            [['ID', 'STORE_TYPE_ID', 'CELL_ID'], 'string', 'max' => 32],
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
            'STORE_TYPE_ID' => 'Store  Type  ID',
            'CELL_ID' => '小区',
            'STATUS' => '状态',
        ];
    }
}
