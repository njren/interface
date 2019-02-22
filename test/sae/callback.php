<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/2/20
 * Time: 10:07
 */
require '../../vendor/autoload.php';
require '../function.php';
use service\WebService;
use factory\SaeFactory;

try {
    $class=new WebService(new SaeFactory($data['sae']['WB_AKEY'],$data['sae']['WB_SKEY'],$data['sae']['WB_CALLBACK_URL']));
    $res=$class->comOAuth();
    if($res['status']==10000){
        var_dump($class->getInfo());
    }else{
        var_dump($res);
    }
} catch (Exception $e) {
    echo $e->getMessage(), "\n";
}