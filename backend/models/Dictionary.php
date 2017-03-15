<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "t_dictionary".
 *
 * @property string $TYPE_NAME
 * @property string $CODE
 * @property string $NAME
 * @property integer $SORT
 */
class Dictionary extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 't_dictionary';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['TYPE_NAME', 'CODE'], 'required'],
            [['SORT'], 'integer'],
            [['TYPE_NAME', 'CODE', 'NAME'], 'string', 'max' => 50],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'TYPE_NAME' => '类型',
            'CODE' => 'Code',
            'NAME' => 'Name',
            'SORT' => 'Sort',
        ];
    }
}
