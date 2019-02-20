<?php
/**
 * Created by PhpStorm.
 * Author: Star coordinates
 * Time: 23:03
 */
namespace service;
class SaeService
{
    protected $obj;
    function __construct($class)
    {
        $this->obj=$class;
    }

    function __call($name, $arguments)
    {
        // TODO: Implement __call() method.
        if($name=='comUrl'||$name=='comOAuth'){
            if($this->obj->token){
                return ['status'=>10004,'code'=>'repeat_login'];
            }
            if($name=='comOAuth'){
                if (!isset($_REQUEST['code'])) {
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
        $res = $this->obj->objectClass();
        if ($res['status'] == 10004) {
            return $res;
        }
        return $this->obj->$name();
    }

    public function getToken(){
        return $this->obj->token;
    }
}
