<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "t_store_goods".
 *
 * @property string $ID
 * @property string $STORE_ID
 * @property string $GOODS_NAME
 * @property string $GOODS_PRICE
 * @property string $STATUS
 * @property string $REMARK
 */
class TStoreGoods extends \yii\db\ActiveRecord implements CanModular
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 't_store_goods';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['ID', 'STORE_ID', 'GOODS_NAME', 'GOODS_PRICE'], 'required'],
            [['ID', 'STORE_ID',  'REMARK'], 'string', 'max' => 32],
            [['GOODS_NAME'], 'string', 'max' => 100],
            [['STATUS'], 'string', 'max' => 50],
            [['GOODS_PRICE', ], 'number'],

        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'ID' => 'ID',
            'STORE_ID' => '商家名称',
            'GOODS_NAME' => '商品名称',
            'GOODS_PRICE' => '商品价格（单位：元）',
            'STATUS' => '状态',
            'REMARK' => '备注',
        ];
    }

    public function getModuleName()
    {
        return 'store-goods';
    }
}
