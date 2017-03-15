<?php

namespace app\models;

use Yii;
use yii\db\Exception;

/**
 * This is the model class for table "t_store_type".
 *
 * @property string $ID
 * @property string $TYPE_NAME
 * @property string $TYPE_URL
 * @property string $PIC_NAME
 * @property integer $SORT
 * @property string $REMARK
 */
class TStoreType extends \yii\db\ActiveRecord implements CanModular
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 't_store_type';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['ID'], 'required'],
            [['SORT'], 'integer'],
            [['ID'], 'string', 'max' => 32],
            [['TYPE_NAME', 'TYPE_URL'], 'string', 'max' => 100],
            [['PIC_NAME'], 'string', 'max' => 50],
            [['REMARK'], 'string', 'max' => 1000],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'ID' => 'ID',
            'TYPE_NAME' => '类型名称',
            'TYPE_URL' => '类型地址',
            'PIC_NAME' => '图片名称',
            'SORT' => '排序',
            'REMARK' => '备注',
        ];
    }

    public function getModuleName()
    {
        return 'store-type';
    }

    public function getStoreTypeCells()
    {
        return $this->hasMany(TStoreTypeCell::className(), ['STORE_TYPE_ID' => 'ID']);
    }
    public static function linkDelete($id)
    {
        $transaction = Yii::$app->db->beginTransaction();
        try {
            $store = TStoreType::find()->where(['ID' => $id])->with('storeTypeCells')->one();
            if (!isset($store)) {
                return;
            }
            if ($store->delete()) {
                $storeTypeCells = $store->storeTypeCells;
                foreach ($storeTypeCells as $storeCell) {
                    if (!$storeCell->delete()) {
                        goto rollBack;
                    }
                }
            }
            $transaction->commit();
        } catch (Exception $e) {
            rollBack: $transaction->rollBack();
        }
    }

    public function getStoreTypeCell()
    {
        //暂时做成一对一
        return $this->hasOne(TStoreTypeCell::className(),['STORE_TYPE_ID'=>'ID']);
    }
}
