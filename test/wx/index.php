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
use factory\WxFactory;

try {
    $class=new WebService(new WxFactory($data['wx'],$data['wxapi']));
    $url=$class->comUrl();
    header('location:'.$url);
} catch (Exception $e) {
    echo $e->getMessage(), "\n";
}