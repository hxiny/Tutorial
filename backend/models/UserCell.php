<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "t_user_cell".
 *
 * @property string $ID
 * @property string $USER_ID
 * @property string $HOUSE_IDENTITY
 * @property string $CELL_ID
 * @property integer $BUILD_ID
 * @property integer $HOUSE_ID
 * @property string $STATUS
 * @property string $IS_DEFAULT
 */
class UserCell extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 't_user_cell';
    }

    /**
     * @inheritdoc
     */

    public function getUser(){
        return $this -> hasOne(User::className(),['USER_ID' => 'USER_ID']);
    }
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['ID'], 'required'],
            [['BUILD_ID', 'HOUSE_ID'], 'integer'],
            [['ID', 'USER_ID', 'HOUSE_IDENTITY'], 'string', 'max' => 50],
            [['CELL_ID'], 'string', 'max' => 32],
            [['STATUS', 'IS_DEFAULT'], 'string', 'max' => 1],
        ];
    }
    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'ID' => 'ID',
            'USER_ID' => '用户ID',
            'HOUSE_IDENTITY' => '房屋身份',
            'CELL_ID' => '小区编号',
            'BUILD_ID' => '楼栋编号',
            'HOUSE_ID' => '房间编号',
            'STATUS' => '房屋状态',
            'IS_DEFAULT' => '是否默认',
        ];
    }

    public function getHouse()
    {
        return $this->hasOne(House::className(), ['ID' => 'HOUSE_ID']);
    }
    public function getBuild()
    {
        return $this->hasOne(Build::className(),['ID'=>'BUILD_ID']);
    }

    public function getCell()
    {
        return $this->hasOne(Cells::className(), ['ID' => 'CELL_ID']);
    }
    public function getUserClient()
    {
        return $this->hasOne(UserClient::className(), ['USER_ID' => 'USER_ID']);
    }
}
