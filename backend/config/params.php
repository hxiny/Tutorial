<?php
return [
    'adminEmail' => 'admin@example.com',

    //设备链接配置
    'device_url' => 'http://121.40.204.191:18080',
    'wx_url' => 'http://develop.wx.imiaodou.com',
    'get_access_url' => 'https://api.weixin.qq.com/cgi-bin/token',

    //限制短信接口访问ip的网段
    'ip_start' 				=> '106.14.0.0',
    'ip_end' 				=> '127.222.222.222',

    //短信调用没匹配到对应app_ip索取的默认值
    'app_id'				=> 'wx775068b42dad2a36',
];
