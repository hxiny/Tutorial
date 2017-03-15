<?php
/**
 * Created by PhpStorm.
 * User: levi
 * Date: 2016/11/14
 * Time: 19:09
 */

namespace backend\controllers;


use app\models\OwnerBill;
use app\models\PayQueue;
use app\models\RedisClient;
use JsApiPay;
use PayNotifyCallBack;
use WxPayApi;
use WxPayConfig;
use WxPayException;
use WxPayNotifyReply;
use WxPayOrderQuery;
use WxPayResults;
use WxPayUnifiedOrder;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\helpers\Url;
use yii\web\Controller;

require_once dirname(__FILE__) . '/../Classes/wxpay/lib/WxPay.Api.php';
require_once dirname(__FILE__) . '/../Classes/wxpay/inter/WxPay.JsApiPay.php';
require_once dirname(__FILE__) . '/../Classes/wxpay/inter/notify.php';

class WxController extends Controller
{
    const REDIS_H_PRE_ID = "H:PRE_ID:";
    const REDIS_H_SESSION = "h_common:";
    public $layout = false;
    public $enableCsrfValidation = false;
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'actions' => ['bill', 'rtn', 'test', 'testrtn'],
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

    public function actionBill()
    {
        $request = \Yii::$app->request;
        $orderNo = $request->get("order_no");
        $sessionId = $request->get("session_id");
        $returnUrl = $request->get("return_url");
        $totalMoney = 1;//todo 通过订单编号获取金额

        $openId = '';
        $userId = '';
        $this->getOpenIdFromRedis($sessionId, $openId, $userId);

        if (!isset($openId)) {
            //todo 返回出错页面
        }

        $isMulti = false;
        $orderList = explode(',', $orderNo);
        if (count($orderList) > 1) {
            //todo 多帐单支付
            $isMulti = true;
        } else {

        }

        $isPayed = false;
        $jsApiParameters = "\"\"";
        $totalMoney = $this->getTotalMoneyFromDb($orderNo, $userId, $isPayed);

        $tools = new JsApiPay();

//②、统一下单
        try {
            if (!$isPayed) {
                $input = new WxPayUnifiedOrder();
                $input->SetBody("test");
                $input->SetAttach("test");
                $input->SetOut_trade_no($orderNo);
                $input->SetTotal_fee("1");
                $input->SetTime_start(date("YmdHis"));
                $input->SetTime_expire(date("YmdHis", time() + 600));
                $input->SetGoods_tag("test");
                $input->SetNotify_url(Url::toRoute(["wx/rtn"], true));
                $input->SetTrade_type("JSAPI");
                $input->SetOpenid($openId);
                $order = WxPayApi::unifiedOrder($input);

                $jsApiParameters = $tools->GetJsApiParameters($order);
            }
        } catch (WxPayException $e) {
            echo $e->getMessage()."\n";
            exit();
        }
        if (!$isMulti) {
            return $this->render('bill', [
                'order' => OwnerBill::find()->where(['BILL_ID' => $orderNo])->one(),
                'jsApiParameters' => $jsApiParameters
            ]);
        } else {
            return $this->render('billMulti', [
                'total_money' => $totalMoney,
                'jsApiParameters' => $jsApiParameters
            ]);
        }
        
    }

    public function actionRtn()
    {
//        $xml = file_get_contents("return.txt");
        //获取通知的数据
        $xml = $GLOBALS['HTTP_RAW_POST_DATA'];
        file_put_contents("return.txt", $xml);

        $reply = new WxPayNotifyReply();
        $orderNo = '';
        $msg = '';
        if ($this->doRtn($xml, $msg, $orderNo)) {
            $this->addToPayQueue($orderNo);
            $reply->SetReturn_code("SUCCESS");
            $reply->SetReturn_msg("OK");
        } else {
            $reply->SetReturn_code("FAIL");
            $reply->SetReturn_msg($msg);
        }

        $rtnXML = $reply->ToXml();
        file_put_contents("rtn_wx.txt", $rtnXML);
        echo $rtnXML;
        exit();
    }

    public function actionTestrtn()
    {
        $xml = file_get_contents("return.txt");

        $reply = new WxPayNotifyReply();
        $orderNo = '';
        $msg = '';
        if ($this->doRtn($xml, $msg, $orderNo)) {
            $this->addToPayQueue($orderNo);
            $reply->SetReturn_code("SUCCESS");
            $reply->SetReturn_msg("OK");
        } else {
            $reply->SetReturn_code("FAIL");
            $reply->SetReturn_msg($msg);
        }

        $rtnXML = $reply->ToXml();
        file_put_contents("rtn_wx.txt", $rtnXML);
        echo $rtnXML;
        exit();
    }

    /**以下为私有方法*/
    private function doRtn($xml, &$msg, &$orderNo)
    {
        try {
            $result = WxPayResults::Init($xml);
        } catch (WxPayException $e){
            $msg = $e->errorMessage();
            return false;
        }

        if(!array_key_exists("transaction_id", $result)){
            $msg = "输入参数不正确";
            return false;
        }
        //查询订单，判断订单真实性
        if(!$this->doQueryOrder($result["transaction_id"])){
            $msg = "订单查询失败";
            return false;
        }

        $orderNo = $result["out_trade_no"];
        return true;
    }

    //查询订单
    private function doQueryOrder($transaction_id)
    {
        $input = new WxPayOrderQuery();
        $input->SetTransaction_id($transaction_id);
        $result = WxPayApi::orderQuery($input);

        if(array_key_exists("return_code", $result)
            && array_key_exists("result_code", $result)
            && $result["return_code"] == "SUCCESS"
            && $result["result_code"] == "SUCCESS")
        {
            return true;
        }
        return false;
    }


    private function addToPayQueue($orderNo)
    {
        $ownerBill = OwnerBill::find()->where(['BILL_ID' => $orderNo, 'PAY_STATUS' => 0])->one();

        if ($ownerBill) {
            $payQueue = new PayQueue();
            $payQueue->ORDER_NO = $orderNo;
            $payQueue->PAY_AMOUNT = $ownerBill->PAY_AMOUNT;
            $payQueue->USER_ID = $ownerBill->PAY_ACCOUNT;
            $payQueue->BILL_TYPE = 0;
            $payQueue->PAY_WAY_TYPE = 0;
            $payQueue->PAY_TIME = date("Y-m-d H:i:s", time());
            $payQueue->CREATE_TIME = date("Y-m-d H:i:s", time());
            $payQueue->STATUS = 0;

            $payQueue->save();
        }
    }

    private function addOrderToRedis($out_trade_no, array $data)
    {
        $redisClient = new RedisClient();
        if (!$redisClient->connect()) {
            return false;
        }

        foreach ($data as $key => $value) {
            $redisClient->hset(self::REDIS_H_PRE_ID.$out_trade_no, $key, $value);
        }

    }

    private function getTotalMoneyFromDb($order_no, $userId, &$isPayed)
    {
        $totalMoney = 0;
        if (is_array($order_no)) {
            foreach ($order_no as $o) {
                $r = OwnerBill::find()->where(['BILL_ID' => $o])->one();
                if ($r) {
                    $status = $r->PAY_STATUS;

                    if ($status > 0) {
                        $isPayed = true;
                    }
                    $totalMoney += $r->PAY_AMOUNT;
                    $r->PAY_ACCOUNT = $userId;
                    $r->save(false);
                }
            }
        } else {
            $r = OwnerBill::find()->where(['BILL_ID' => $order_no])->one();
            $status = $r->PAY_STATUS;

            if ($status > 0) {
                $isPayed = true;
            }
            $totalMoney = $r->PAY_AMOUNT;
            $r->PAY_ACCOUNT = $userId;
            $r->save(false);
        }
        
        return $totalMoney;
    }

    private function getOpenIdFromRedis($session, &$openId, &$userId)
    {
        $redisClient = new RedisClient();
        if (!$redisClient->connect()) {
            return;
        }

        $name = self::REDIS_H_SESSION.$session;
        $openId =  $redisClient->hget($name, "openid");
        $userId =  $redisClient->hget($name, "user_id");
    }
}