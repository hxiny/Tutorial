<?php

namespace app\models;

use Yii;
use yii\db\Exception;

/**
 * This is the model class for table "t_store".
 *
 * @property string $ID
 * @property string $NAME
 * @property string $PIC_URL
 * @property string $STORE_TYPE
 * @property string $STORE_INTRODUCT
 * @property string $STORE_IMG
 * @property integer $IS_TOP
 * @property string $PHONE
 * @property string $LANDLINE
 * @property integer $STAR_LEVEL
 * @property integer $AWAY_FROM
 * @property string $ADDRESS
 * @property string $BOSS_NAME
 * @property string $BOSS_CERT
 * @property string $OPEN_TIME
 * @property string $CERT_INFO
 * @property string $CREATE_TIME
 * @property string $UPDATE_TIME
 * @property string $CREATE_USER
 * @property string $UPDATE_USER
 * @property string $REMARK
 */
class TStore extends \yii\db\ActiveRecord implements  CanModular
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 't_store';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['ID'], 'required'],
            [['IS_TOP', 'STAR_LEVEL', 'AWAY_FROM'], 'integer'],
            [['ID', 'NAME', 'STORE_TYPE', 'BOSS_NAME', 'BOSS_CERT', 'OPEN_TIME', 'CREATE_USER', 'UPDATE_USER'], 'string', 'max' => 50],
            [['STORE_INTRODUCT'], 'string', 'max' => 200],
            [['STORE_IMG', 'CERT_INFO'], 'string', 'max' => 400],
            [['PHONE', 'LANDLINE'], 'string', 'max' => 15],
            [['ADDRESS'], 'string', 'max' => 150],
            [['CREATE_TIME', 'UPDATE_TIME'], 'string', 'max' => 20],
            [['REMARK'], 'string', 'max' => 255],
            [['PIC_URL'], 'file', 'extensions' => 'jpg,png']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'ID' => '商家编号',
            'NAME' => '商家名称',
            'PIC_URL' => '商家图片',
            'STORE_TYPE' => '商家类型',
            'STORE_INTRODUCT' => '商家简介',
            'STORE_IMG' => '商家图片',
            'IS_TOP' => '是否置顶',
            'PHONE' => '联系电话',
            'LANDLINE' => '座机',
            'STAR_LEVEL' => '星级',
            'AWAY_FROM' => '距离（单位：米）',
            'ADDRESS' => '商家地址',
            'BOSS_NAME' => '法人姓名',
            'BOSS_CERT' => '法人身份证',
            'OPEN_TIME' => '营业时间',
            'CERT_INFO' => '证件信息',
            'CREATE_TIME' => '创建时间',
            'UPDATE_TIME' => '修改时间',
            'CREATE_USER' => '创建人',
            'UPDATE_USER' => '修改人员',
            'REMARK' => '备注信息',
        ];
    }

    public function getStoreCells()
    {
        return $this->hasMany(TStoreCell::className(), ['STORE_ID'=>'ID']);
    }

    public function getGoods()
    {
        return $this->hasMany(TStoreGoods::className(), ['STORE_ID'=>'ID']);
    }

    public function getModuleName()
    {
        return 'store';
    }
    public static function batchDelete($ids)
    {
        foreach ($ids as $id) {
            self::linkDelete($id);
        }
    }

    public static function linkDelete($id)
    {
        $transaction = Yii::$app->db->beginTransaction();
        try {
            $store = TStore::find()->where(['ID' => $id])->with('storeCells')->with('goods')->one();
            if (!isset($store)) {
                return;
            }
            if ($store->delete()) {
                //删除商家已经关联的小区
                $storeCells = $store->storeCells;
                foreach ($storeCells as $storeCell) {
                    if (!$storeCell->delete()) {
                        goto rollBack;
                    }
                }
                //删除商家的所有商品
                $goodses = $store->goods;
                foreach ($goodses as $goods) {
                    if (!$goods->delete()) {
                        goto rollBack;
                    }
                }
            }
            $transaction->commit();
        } catch (Exception $e) {
            rollBack: $transaction->rollBack();
        }
    }
}
