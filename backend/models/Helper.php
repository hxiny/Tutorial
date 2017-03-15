<?php
/**
 * Created by PhpStorm.
 * User: levi
 * Date: 2016/11/2
 * Time: 16:52
 */

namespace app\models;

use Yii;
use yii\base\Exception;

class Helper
{
    const TOKEN = "hxxq";
    const APP_ID = "wx8b666f67ea5e78f1";
    const SECRET = "c07cf13a559fa57eb4e3b6de0aa11ecd";
    const SCOPE = "snsapi_userinfo";

    const DAYU_APPKEY = "23511904";
    const DAYU_SECRET = "e90a579b9c000f6dbac0118334136994";

    const QINIU_ACCESS_KEY = "0eT5Ip46iGxH_GYZ9S9TnXjWp3Kqa_1pGcR5xsBh";
    const QINIU_SECRET_KEY = "vcaUzD2-3FSOb_mKXPN5osMtLBotpH8HQou2JQ48";

    public static function curl_ssl($url) {
        $curl = curl_init();

        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);//如果成功只将结果返回，不自动输出任何内容。
        curl_setopt($curl, CURLOPT_TIMEOUT, 500); //作为最大延续500毫秒，超过这个时间将不去读取页面

        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);//不检测服务器的证书是否由正规浏览器认证过的授权CA颁发

        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);//不检测服务器的域名与证书上的是否一致

        curl_setopt($curl, CURLOPT_URL, $url);//设置提交地址路径

        $res = curl_exec($curl);//执行，并接收返回结果

        curl_close($curl);//关闭.

        return $res;
    }
    
    public static function curl_post($url, $post_data) {
        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        // post数据
        curl_setopt($ch, CURLOPT_POST, 1);
        // post的变量
        curl_setopt($ch, CURLOPT_POSTFIELDS, $post_data);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
                'Content-Type: application/json',
                'Content-Length: ' . strlen($post_data))
        );

        $output = curl_exec($ch);
        curl_close($ch);

        return $output;
    }

    public static function curl_post1($url, $post_data) {
        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        // post数据
        curl_setopt($ch, CURLOPT_POST, 1);
        // post的变量
        curl_setopt($ch, CURLOPT_POSTFIELDS, $post_data);
        $output = json_decode(curl_exec ( $ch ));

        curl_close($ch);

        return $output;
    }
    
    public static function get_cur_time_format() {
        return date("Y-m-d H:i:s", time());
    }

    public static function redirect_type_list() {
        return [
            'home' => "house/index.html",
            'center' => "house/m_center/p_home.html",
            'lock' => "house/m_key/open_door.html",
            'share_lock' => "house/m_key/open_door_share.html"
        ];
    }
    
    public static function get_redirect_type($typeName) {
        $array = self::redirect_type_list();
        
        if (key_exists($typeName, $array)) {
            return $array[$typeName];
        } else {
            return $array["home"];
        }
    }

    public static function getNonceStr($length = 32)
    {
        $chars = "abcdefghijklmnopqrstuvwxyz0123456789";
        $str ="";
        for ( $i = 0; $i < $length; $i++ )  {
            $str .= substr($chars, mt_rand(0, strlen($chars)-1), 1);
        }
        return $str;
    }

    public static function createID()
    {
        return time().Helper::getNonceStr(10);
    }

    public static function setCreateTimeAndCreateUser($model,$timeField='CREATE_TIME',
                                                      $userField='CREATE_USER')
    {
        $curLoginUserName = Yii::$app->user->identity->username;
        $curTime = Helper::get_cur_time_format();
        $model->$timeField = $curTime;
        $model->$userField = $curLoginUserName;
    }

    public static function setUpdateTimeAndUpdateUser($model, $updateTimeField='UPDATE_TIME', $updateUserField='UPDATE_USER')
    {
        $curLoginUserName = Yii::$app->user->identity->username;
        $curTime = Helper::get_cur_time_format();
        $model->$updateTimeField = $curTime;
        $model->$updateUserField = $curLoginUserName;
    }
    public static function doTransaction($handler)
    {
        $transaction=YII::$app->db->beginTransaction();
        try {
            if ($handler()) {
                $transaction->commit();
                return true;
            }else{
                $transaction->rollBack();
            }
        } catch (Exception $e) {
            $transaction->rollBack();
        }
        return false;
    }

}