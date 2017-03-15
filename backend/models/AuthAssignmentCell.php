<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "auth_assignment_cell".
 *
 * @property integer $id
 * @property string $item_name
 * @property string $user_id
 * @property integer $cell_id
 * @property integer $created_at
 */
class AuthAssignmentCell extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'auth_assignment_cell';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['item_name', 'user_id', 'cell_id'], 'required'],
            [['cell_id', 'created_at'], 'integer'],
            [['item_name', 'user_id'], 'string', 'max' => 64],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'item_name' => 'Item Name',
            'user_id' => 'User ID',
            'cell_id' => 'Cell ID',
            'created_at' => 'Created At',
        ];
    }

    public function getRole()
    {
        return $this->hasOne(AuthItem::className(), ['name' => 'item_name'])->where(['type' => 1]);
    }
}
