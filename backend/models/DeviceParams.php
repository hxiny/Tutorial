<?php

namespace app\models;

use Yii;
use Yii\helpers\ArrayHelper;

/**
 * This is the model class for table "t_device_params".
 *
 * @property integer $ID
 * @property string $APP_ID
 * @property string $GID
 * @property string $AGT_NUM
 * @property string $MD_BINDINGS_URL
 * @property string $MD_OPENDOOR_URL
 * @property string $MD_SHARE_URL
 * @property string $APP_KEY
 */
class DeviceParams extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 't_device_params';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            // [['ID'], 'required'],
            [['ID'], 'integer'],
            [['APP_ID', 'GID', 'AGT_NUM', 'APP_KEY'], 'string', 'max' => 50],
            [['MD_BINDINGS_URL', 'MD_OPENDOOR_URL', 'MD_SHARE_URL'], 'string', 'max' => 500],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'ID' => 'ID',
            'APP_ID' => '公众号',
            'GID' => '公众号原始编号',
            'AGT_NUM' => '服务端认证编号',
            'MD_BINDINGS_URL' => '秒兜服务器地址',
            'MD_OPENDOOR_URL' => 'Md  Opendoor  Url',
            'MD_SHARE_URL' => 'Md  Share  Url',
            'APP_KEY' => '服务端认证',
        ];
    }

    /**
     * @inheritdoc
     */
    public static function wxClientInfo(){
        $cellIds = \app\models\Utils::authCells();
        $wxInfo = (new \Yii\db\Query())
                    ->select('i.*')
                    ->from('wx_client_info AS i')
                    ->leftJoin('wx_client_cells AS c', 'i.app_id = c.app_id')
                    ->where(['c.cell_id'=>$cellIds])
                    ->all();
        $wxInfoArray = ArrayHelper::map($wxInfo, 'app_id','name'); 
        return $wxInfoArray;
    }
}
