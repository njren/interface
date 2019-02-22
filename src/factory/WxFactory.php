<?php
/**
 * Created by PhpStorm.
 * Author: Star coordinates
 * Time: 22:20
 */
namespace factory;
use interfaces\OAuth;
use util\Curl;
class WxFactory implements OAuth
{
    public $token=null;
    public $refresh_token=null;
    public $openid=null;
    public $object=null;
    private $wx_config;
    private $wx_api;

    function __construct($config,$api)
    {
        $this->wx_config=$config;
        $this->wx_api=$api;
    }

    //发起授权请求路径
    public function comUrl(){
        $url=$this->wx_api['code']."?appid=".$this->wx_config['APPID']."&redirect_uri=".$this->wx_config['REDIRECT_URI']."&response_type=code&scope=snsapi_login&state=".$this->wx_config['STATE']."#wechat_redirect";
        return $url;
    }

    //验证token是否有效
    public function authToken(){
        if($this->openid==null){
            return ['status'=>10004,'code'=>'login_error'];
        }
        $url=$this->wx_api['auth']."?access_token=".$this->token."&openid=".$this->openid;
        $tokenauth=$this->object2array(Curl::curlGet($url));
        if($tokenauth->errcode==0){
            return ['status'=>10000,'code'=>$tokenauth->errmsg];
        }else{
            return ['status'=>10004,'code'=>'gain_token'];
        }
    }

    //刷新token
    public function refreshToken(){
        if($this->refresh_token==null){
            return ['status'=>10004,'code'=>'login_error'];
        }
        $url=$this->wx_api['refresh_token']."?appid=".$this->wx_config['APPID']."&grant_type=refresh_token&refresh_token=".$this->refresh_token;
        $tokenrefresh=$this->object2array(Curl::curlGet($url));
        if(!empty($tokenrefresh->access_token)){
            $this->token=$tokenrefresh->access_token;
            $this->refresh_token=$tokenrefresh->refresh_token;
        }else{
            return ['status'=>10004,'code'=>'refresh_error'];
        }
    }

    //授权获得token一并获得openid
    public function comOAuth()
    {
        if(!isset($_REQUEST['state'])||$_REQUEST['state']!=$this->wx_config['STATE']){
            return ['status'=>10004,'code'=>'illegal_url'];
        }
        $code=$_REQUEST['code'];
        $url=$this->wx_api['token']."?appid=".$this->wx_config['APPID']."&secret=".$this->wx_config['SECRET']."&code=".$code."&grant_type=authorization_code";
        $tokenjson=$this->object2array(Curl::curlGet($url));
        if(!empty($tokenjson->access_token)&&!empty($tokenjson->openid)){
            $this->token=$tokenjson->access_token;
            $this->openid=$tokenjson->openid;
            $this->refresh_token=$tokenjson->refresh_token;
            return ['status'=>10000,'code'=>''];
        }else{
            return ['status'=>10004,'code'=>'gain_token'];
        }
    }

    private function object2array($object) {
        $object =  json_decode($object);
        return  $object;
    }

    //获取会员uid
    public function getUid(){
        if($this->openid==null){
            return ['status'=>10004,'code'=>'login_error'];
        }
        return  $this->openid;
    }

    //获取会员信息
    public function getInfo(){
        if($this->openid==null){
            return ['status'=>10004,'code'=>'login_error'];
        }
        $url=$this->wx_api['userinfo']."?access_token=".$this->token."&openid=".$this->openid;
        $openjson=$this->object2array(Curl::curlGet($url));
        if(!empty($openjson->openid)){
            return array(
                "nickname"=>$openjson->nickname,
                "sex"=>$openjson->sex,
                "province"=>$openjson->province,
                "city"=>$openjson->city,
                "country"=>$openjson->country,
                "headimgurl"=> $openjson->headimgurl,
                "privilege"=>$openjson->privilege,
                "unionid"=> $openjson->unionid
            );
        }else{
            return ['status'=>10004,'code'=>'usermsg_error'];
        }
    }
}