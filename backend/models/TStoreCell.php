<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "t_store_cell".
 *
 * @property string $ID
 * @property string $STORE_ID
 * @property string $CELL_ID
 * @property string $STATUS
 */
class TStoreCell extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 't_store_cell';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['ID'], 'required'],
            [['ID', 'STORE_ID', 'CELL_ID'], 'string', 'max' => 32],
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
            'STORE_ID' => 'Store  ID',
            'CELL_ID' => 'Cell  ID',
            'STATUS' => 'Status',
        ];
    }

    public function getCells()
    {
        return $this->hasOne(Cells::className(), ['ID' => 'CELL_ID']);
    }
}
