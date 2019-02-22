<?php
/**
 * Created by PhpStorm.
 * Author: Star coordinates
 * Time: 22:20
 */
namespace factory;
use interfaces\OAuth;
use util\qq\QC;
class QFactory implements OAuth
{
    public $token=null;
    public $object=null;
    private $qq_config;

    function __construct($config)
    {
        $this->qq_config=$config;//获取一个json字符串
    }

    public function objectClass(){
        $this->object = new QC($this->qq_config);
    }

    //创建连接窗体
    public function windows(){
        $this->object->qq_login();
    }

    //发起授权获得token
    public function comOAuth()
    {
        $this->token=$this->object->qq_callback();
        return $this->token;
    }

    //获取openid
    public function getUid(){
        return $this->object->get_openid();
    }

    //获取会员信息
    public function getInfo(){
        $arr = $this->object->get_user_info();
        return $arr;
    }
}