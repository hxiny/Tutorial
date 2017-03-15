<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "wx_client_cells".
 *
 * @property string $id
 * @property string $cell_id
 * @property string $app_id
 * @property string $create_date
 * @property string $update_date
 * @property integer $status
 */
class WxClientCells extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'wx_client_cells';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['create_date', 'update_date'], 'safe'],
            [['status'], 'integer'],
            [['cell_id', 'app_id'], 'string', 'max' => 50],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'cell_id' => 'Cell ID',
            'app_id' => 'App ID',
            'create_date' => 'Create Date',
            'update_date' => 'Update Date',
            'status' => 'Status',
        ];
    }
}
