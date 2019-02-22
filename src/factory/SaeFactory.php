<?php
/**
 * Created by PhpStorm.
 * Author: Star coordinates
 * Time: 22:20
 */
namespace factory;
use interfaces\OAuth;
use util\sae\TOAuthV2;
use util\sae\TClientV2;
use util\sae\OAuthException;
class SaeFactory implements OAuth
{
    public $token=null;
    public $object=null;
    private $wb_akey;
    private $wb_skey;
    private $wb_callback_url;

    function __construct($akey,$skey,$url)
    {
        $this->wb_akey=$akey;
        $this->wb_skey=$skey;
        $this->wb_callback_url=$url;
    }

    public function objectClass(){
        if($this->token) {
            $this->object = new TClientV2($this->wb_akey, $this->wb_skey, $this->token['access_token']);
        }else {
            $this->object = new TOAuthV2($this->wb_akey, $this->wb_skey);
        }
    }

    //获得请求路径
    public function comUrl(){
        $code_url = $this->object->getAuthorizeURL( $this->wb_callback_url );
        return $code_url;
    }

    //发起授权获得token
    public function comOAuth()
    {
        // TODO: Implement comOAuth() method.
        $keys=array();
        $keys['code'] = $_REQUEST['code'];
        $keys['redirect_uri'] = $this->wb_callback_url;
        try {
            $this->token = $this->object->getAccessToken( 'code', $keys ) ;
            return ['status'=>10000,'code'=>$this->token];
        } catch (OAuthException $e) {
        }
    }

    //获取token对象
    public function getUid(){
        $uid_get = $this->object->get_uid();//OAuth授权之后，获取授权用户的UID
        $uid = $uid_get['uid'];
        return $uid;
    }

    //获取会员信息
    public function getInfo(){
        $user_message = $this->object->show_user_by_id( $this->getUid());//根据ID获取用户等基本信息
        return $user_message;
    }

    //获取当前登录用户及其所关注用户的最新微博消息
    public function getMsg(){
        $ms  = $this->object->home_timeline();
        return $ms;
    }
}