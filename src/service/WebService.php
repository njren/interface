<?php
/**
 * Created by PhpStorm.
 * Author: Star coordinates
 * Time: 23:03
 */
namespace service;
class WebService
{
    protected $obj;
    protected $power=array(
        'autoloading'=>array('factory\WxFactory'),
        'function'=>array(
            'comOAuth'=>array('factory\SaeFactory','factory\WxFactory')
        ),
        'notoken'=>array('comUrl','comOAuth','windows')
    );
    function __construct($class)
    {
        $this->obj=$class;
    }

    function __call($name, $arguments)
    {
        // TODO: Implement __call() method.
        $classname=get_class($this->obj);
        if(in_array($name, $this->power['notoken'])){
            if($this->obj->token){
                return ['status'=>10004,'code'=>'repeat_login'];
            }
            if($name=='comOAuth'){
                if (in_array($classname, $this->power['function'][$name])&&!isset($_REQUEST['code'])) {
                    return ['status'=>10004,'code'=>'illegal_url'];
                }
            }
        }else{
            if($name=='objectClass'){
                return ['status'=>10004,'code'=>'function_error'];
            }
            if(!$this->obj->token){
                return ['status'=>10004,'code'=>'login_error'];
            }
        }
        if(!in_array($classname, $this->power['autoloading'])) {
            $res = $this->obj->objectClass();
            if ($res['status'] == 10004) {
                return $res;
            }
        }
        return $this->obj->$name();
    }

    public function getToken(){
        return $this->obj->token;
    }
}
