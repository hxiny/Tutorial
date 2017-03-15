<?php
/**
 * Created by PhpStorm.
 * User: levi
 * Date: 2016/11/2
 * Time: 20:51
 */

namespace backend\controllers;


use AlibabaAliqinFcSmsNumSendRequest;
use app\models\Helper;
use app\models\WxUserInfo;
use app\models\WxClientInfo;
use app\models\SystemSmsConfiguration;
use Qiniu\Auth;
use TopClient;
use WxPayApi;
use Yii;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\helpers\Url;
use yii\web\Controller;

require_once dirname(__FILE__) . '/../Classes/dayu/TopSdk.php';

class OpenController extends Controller
{
    public $layout = false;
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'actions' => ['test', 'after', 'wx', 'sendmsg', 'uptoken'],
                        'allow' => true,
                    ],
                    [
                        'actions' => ['logout', 'index'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
        ];
    }
    public function actionWx()
    {
        $request = Yii::$app->getRequest();

        $redirect_type = $request->get("redirect_type", "home");
        $redirectUrl = urlencode(Url::toRoute(['open/after'], true));
        $id = $request->get("id");
        $model = WxClientInfo::findOne(['id' => $id]);
        if(!isset($model)){
            $model = new WxClientInfo();
            $model->app_id = Helper::APP_ID;
            $model->ap_secret = Helper::SECRET;
        }
        $appId = $model->app_id;
        $scope = Helper::SCOPE;
        $state = $redirect_type."@".$appId;
//        $redirectUrl = $redirectUrl."%26appid=".$appId;
        $url = "https://open.weixin.qq.com/connect/oauth2/authorize?appid=$appId";
        $url .= "&redirect_uri=$redirectUrl&response_type=code&scope=$scope&state=$state#wechat_redirect";
        return $this->redirect($url);
    }

    public function actionAfter()
    {
        $request = Yii::$app->request;
        $code = $request->get("code");
        $state = $request->get("state");
        $stateArray = explode("@", $state);

        $inAppId = "";
        $inRedirectType = "";
        if (count($stateArray) > 1) {
            $inAppId = $stateArray[1];
            $inRedirectType = $stateArray[0];
        }
        $model = WxClientInfo::findOne(['app_id' => $inAppId]);
        if(!isset($model)){
            $model = new WxClientInfo();
            $model->app_id = Helper::APP_ID;
            $model->ap_secret = Helper::SECRET;
        }
        $appId = $model->app_id;
        $secret = $model->ap_secret;
        $url = "https://api.weixin.qq.com/sns/oauth2/access_token?appid=$appId&secret=$secret&code=$code&grant_type=authorization_code";

        $json = Helper::curl_ssl($url);

        file_put_contents("open.txt", $json);
        $jsonArray = json_decode($json, true);
        $accessToken = $jsonArray["access_token"];
        $expiresIn = $jsonArray["expires_in"];
        $refreshToken = $jsonArray["refresh_token"];
        $openid = $jsonArray["openid"];
        $scope = $jsonArray["scope"];

        if (isset($openid)) {
            //update or insert wx user info
            $isOk = $this->getWxUserInfo($openid, $accessToken);

            if ($isOk) {
                $sessionId = "";
                $houseIdentity = "";
                $isOk = $this->getSessionRemote($openid, $inAppId, $sessionId, $houseIdentity);

                if ($isOk) {
                    $homeUrl = $this->makeHomeUrl($inRedirectType, $sessionId, $houseIdentity);
                    return $this->redirect($homeUrl);
                }
            }
        }

        return $this->redirect(Url::toRoute(['site/error']));//todo 出错页面统一返回
    }

    private function updateOrInsertWxUserInfo(array $jsonArray)
    {
        $openid = $jsonArray["openid"];
        $nickname = $jsonArray["nickname"];
//        $tmpStr = json_encode($nickname);
//        $tmpStr = preg_replace("#(\\\ue[0-9a-f]{3})#ie","addslashes('\\1')",$tmpStr);
//        $nickname = json_decode($tmpStr);
//		$nickname = base64_encode($nickname);
        $sex = $jsonArray["sex"];
        $province = $jsonArray["province"];
        $city = $jsonArray["city"];
        $country = $jsonArray["country"];
        $headimgurl = $jsonArray["headimgurl"];
        $privilege = $jsonArray["privilege"];

        $model = WxUserInfo::findOne(['open_id' => $openid]);

        if (!$model) {
            $model = new WxUserInfo();
            $model->open_id = $openid;
        }

        $model->nickname = $nickname;
        $model->sex = $sex;
        $model->province = $province;
        $model->city = $city;
        $model->country = $country;
        $model->headimgurl = $headimgurl;
        $model->update_time = date("Y-m-d H:i:s", time());
        $model->save(false);

        return true;
    }

    private function getWxUserInfo($openid, $accessToken) {
        file_put_contents("open1.txt", $accessToken."\r\n".$accessToken);
        $url = "https://api.weixin.qq.com/sns/userinfo?access_token=$accessToken&openid=$openid&lang=zh_CN";

        $wxInfoJson = Helper::curl_ssl($url);

        $jsonArray = json_decode($wxInfoJson, true);

        file_put_contents("wxInfo.txt", $wxInfoJson);
        if (isset($jsonArray)) {
            return $this->updateOrInsertWxUserInfo($jsonArray);
        }

        return false;
    }

    private function getSessionRemote($openId, $appId, &$sessionId, &$houseIdentity)
    {
//        $url = "http://139.224.164.241:9082/services/weChat";  //测试服务器地址
        $url = "http://106.14.21.180:9082/services/weChat";
//        $url = "http://192.168.1.110:9082/services/weChat";

        $nonceStr = Helper::getNonceStr();
        $postData = "{\"id\":\"id_weChat_$nonceStr\",\"method\":\"weChat\",\"params\":{\"openid\":\"$openId\",\"appid\":\"$appId\"}}";

        $returnData = Helper::curl_post($url, $postData);
        file_put_contents("remote.txt", $returnData);
        $returnJson = json_decode($returnData, true);

        if (!isset($returnJson)) {
            return false;
        }

        if (key_exists("error", $returnJson)){
            return false;
        }

        if (!key_exists("result", $returnJson)){
            return false;
        }

        $result = $returnJson["result"];

        if (!key_exists("session_id", $result)){// || !key_exists("house_identity", $result)){
            return false;
        }

        $sessionId = $result["session_id"];
//        $houseIdentity = $result["house_identity"];

        if (!isset($sessionId)){// || !isset($houseIdentity)) {
            return false;
        }

        return true;
    }

    private function makeHomeUrl($directType, $sessionId, $houseIdentity)
    {
        $redirectUrl = Helper::get_redirect_type($directType);
        file_put_contents("url1.txt", $redirectUrl);
//        $url = "http://m.yunzhongb.com/".$redirectUrl."?session_id=$sessionId";//&house_identity=$houseIdentity";
//        http://m.lifengsoft.com
        $url = "http://m.lifengsoft.com/".$redirectUrl."?session_id=$sessionId";//&house_identity=$houseIdentity";

        return $url;
    }

    public function actionTest()
    {
        $jsonData = file_get_contents("wxInfo--b.txt");
        $jsonArray = json_decode($jsonData, true);

        $this->updateOrInsertWxUserInfo($jsonArray);
        exit();
    }
    
    public function actionSendmsg()
    {
        $request = Yii::$app->request;
        $phone = $request->get("phone");
        $appId = $request->get("app_id");

        $clientIp = $this::getIpLong($this::getClientIP());
        $ipStart = $this::getIpLong(Yii::$app->params['ip_start']);
        $ipEnd = $this::getIpLong(Yii::$app->params['ip_end']);
        if($clientIp < $ipStart || $clientIp > $ipEnd){
            echo $this->error("非法请求");
            exit();
        }

        if (!isset($phone) || !isset($appId)) {
            echo $this->error("参数错误");
            exit();
        }

        if(!preg_match("/^1[34578]\d{9}$/", $phone)){
            echo $this->error("手机号码不正确");
            exit();
        }

        $verifyCode = rand(1000,9999);

        $smsConfiguration = SystemSmsConfiguration::find() ->where(['app_id' => $appId, 'type' => 2]) ->asArray()->one();
        if (empty($smsConfiguration)) {
            $smsConfiguration = SystemSmsConfiguration::find() -> where(['app_id' => Yii::$app->params['app_id'], 'type' => '2']) -> asArray() -> one();
        }
        $smsArray = $smsConfiguration;
        if (empty($smsArray)) {
            echo $this->error('系统出错');
            exit();
        }

        $c = new TopClient;
        // $c->appkey = Helper::DAYU_APPKEY;
        // $c->secretKey = Helper::DAYU_SECRET;    
        $c->appkey = $smsArray['app_key'];
        $c->secretKey = $smsArray['secret_key'];
        $req = new AlibabaAliqinFcSmsNumSendRequest;
        $req->setExtend($smsArray['extend']);
        $req->setSmsType($smsArray['sms_type']);
        $req->setSmsFreeSignName($smsArray['sms_free_sign_name']);
        $req->setSmsParam('{"code":"'.$verifyCode.'"}');
        $req->setRecNum($phone);
        $req->setSmsTemplateCode($smsArray['sms_template_code']);
        $resp = $c->execute($req);

        if (! isset($resp->code)) {
            //成功
            $smsHistory = new \app\models\SmsHistory();
            $smsHistory->app_id = $smsArray['app_id'];
            $smsHistory->phone = $phone;
            $smsHistory->type = '1';
            $smsHistory->send_time = date('Y-m-d H:i:s'); 
            $smsHistory->save();
            echo $this->success($verifyCode);
        } else {
            //失败
            echo $this->error("发送失败");
        }
        exit();
    }

    public function actionUptoken()
    {
        $accessKey = Helper::QINIU_ACCESS_KEY;
        $secretKey = Helper::QINIU_SECRET_KEY;
        $auth = new Auth($accessKey, $secretKey);

        // 空间名  http://developer.qiniu.com/docs/v6/api/overview/concepts.html#bucket
        $bucket = 'xq-public';

        // 生成上传Token
        $token = $auth->uploadToken($bucket);

        echo $this->success($token);
        exit();
    }

    private function success($data)
    {
        $result = array("result" => $data);

        return json_encode($result);
    }

    private function error($errorMsg)
    {
        $result = array("error" => $errorMsg);

        return json_encode($result);
    }

    private function getClientIP()  
    {  
        global $ip;  
        if (getenv("HTTP_CLIENT_IP"))  
            $ip = getenv("HTTP_CLIENT_IP");  
        else if(getenv("HTTP_X_FORWARDED_FOR"))  
            $ip = getenv("HTTP_X_FORWARDED_FOR");  
        else if(getenv("REMOTE_ADDR"))  
            $ip = getenv("REMOTE_ADDR");  
        else $ip = "Unknow";  
        return $ip;  
    }  
    private function getIpLong($ip){
        return bindec(decbin(ip2long($ip)));
    }

}