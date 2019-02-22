<?php
return array(
    'sae' => array(
        'WB_AKEY' => '*******',
        'WB_SKEY' => '******************',
        'WB_CALLBACK_URL' => 'http://*******/**********/callback.php'
    ),
    'qq' => array(
        'appid' => '*******',
        'appkey' => '******************',
        'frame'=>'TencentLogin',
        'callback' => 'http://*******/**********/callback.php',
        'pro'=>'width=450,height=320,menubar=0,scrollbars=1, resizable=1,status=1,titlebar=0,toolbar=0,location=1'
    ),
    'wx' => array(
        'APPID' => '*******',
        'SECRET' => '******************',
        'STATE' => '*****',
        'REDIRECT_URI' => '***************',
        'URI' => 'http://*******/**********/callback.php'
    ),
    'wxapi' => array(
        'code' => 'https://open.weixin.qq.com/connect/qrconnect',
        'token' => 'https://api.weixin.qq.com/sns/oauth2/access_token',
        'auth' => 'https://api.weixin.qq.com/sns/auth',
        'refresh_token' => 'https://api.weixin.qq.com/sns/oauth2/refresh_token',
        'userinfo' => 'https://api.weixin.qq.com/sns/userinfo'
    ),
);
