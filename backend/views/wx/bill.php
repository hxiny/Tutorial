<?php
    $status = 0;
    if (isset($order)) {
        $total_money = $order->PAY_AMOUNT;
        $pay_start_date = $order->PAY_START_DATE;
        $startTime = strtotime($pay_start_date);
        $bill_year = date("Y", $startTime);
        $bill_month = date("m", $startTime);
        $bill_id = $order->BILL_ID;
        $status = $order->PAY_STATUS;
    }

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title><?=$bill_year?>年<?=$bill_month?>月份账单明细</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no">
    <meta name="description" content="">
    <link rel="stylesheet" href="//res.wx.qq.com/open/libs/weui/1.0.0/weui.min.css">
    <link rel="stylesheet" href="/css/toastr.min.css">
    <link rel="stylesheet" href="/css/index.css">
    <link rel="stylesheet" href="/lib/font-awesome/css/font-awesome.min.css">
</head>

<body>
<div class="m_charge_detail page">
    <div class="weui-cells__title"><?=$bill_year?>年<?=$bill_month?>月份账单明细</div>
    <?php
    $payProjects = \app\models\PayProject::find()->where(['BILL_ID' => $bill_id])->all();
    foreach ($payProjects as $payProject) {

        $payType = \app\models\DropListHelper::get_bill_pay($payProject->PROJECT_ID);
        $payAmount = $payProject->PAY_AMOUNT;

        echo "<div class=\"weui-form-preview\">";
        echo "<div class=\"weui-form-preview__bd\">";

        echo "<p>";
        echo "<label class=\"weui-form-preview__label\">费用类型</label>";
        echo "<span class=\"weui-form-preview__value\">$payType</span>";
        echo "</p>";

        echo "<p>";
        echo "<label class=\"weui-form-preview__label\">费用金额</label>";
        echo "<span class=\"weui-form-preview__value\">$payAmount</span>";
        echo "</p>";

        echo "</div>";
        echo "</div>";
        echo "<br/>";
    }
    ?>
    <div class="weui-form-preview">
        <div class="weui-form-preview__hd">
            <label class="weui-form-preview__label">总计金额</label>
            <em class="weui-form-preview__value">¥<?=$total_money?></em>
        </div>
        <div class="weui-form-preview__bd">
            <p>
                <label class="weui-form-preview__label">账单状态</label>
                <span class="weui-form-preview__value">
                    <?php
                    $payStatus = $order->PAY_STATUS;

                    if ($payStatus == 1) {
                        echo "支付成功";
                    } else {
                        echo "<span style=\"color:#F00\">未支付</span>";
                    }
                    ?>
                </span>
            </p>
        </div>
        <div class="weui-form-preview__ft">
            <a class="weui-form-preview__btn weui-form-preview__btn_default" onclick="back()">返回账单</a>
            <a type="submit" class="weui-form-preview__btn weui-form-preview__btn_primary" href="#" onclick="callpay()">立即缴费</a>
        </div>
    </div>

    <div id="footer"></div>
</div>
<script type="text/javascript" src="/lib/jquery-2.0.0.min.js"></script>
<script type="text/javascript" src="/lib/toastr.min.js"></script>
<script type="text/javascript" src="//cdn.bootcss.com/Swiper/3.3.1/js/swiper.jquery.min.js "></script>
<script>
    //调用微信JS api 支付
    function jsApiCall()
    {
        WeixinJSBridge.invoke(
            'getBrandWCPayRequest',
            <?php echo $jsApiParameters; ?>,
            function(res){
                WeixinJSBridge.log(res.err_msg);
                alert(res.err_code+res.err_desc+res.err_msg);
            }
        );
    }

    function callpay()
    {
        var status = "<?=$status?>";
        if (status != "0") {
            alert("订单已不能支付！");
            return;
        }
        if (typeof WeixinJSBridge == "undefined"){
            if( document.addEventListener ){
                document.addEventListener('WeixinJSBridgeReady', jsApiCall, false);
            }else if (document.attachEvent){
                document.attachEvent('WeixinJSBridgeReady', jsApiCall);
                document.attachEvent('onWeixinJSBridgeReady', jsApiCall);
            }
        }else{
            jsApiCall();
        }
    }

    function back()
    {
        window.history.back();
    }
</script>
</body>

</html>