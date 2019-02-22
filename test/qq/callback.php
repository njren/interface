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
use factory\QFactory;

try {
    $class=new WebService(new QFactory(json_encode($data['qq'])));
    echo $class->comOAuth();
    echo "<br/>";
    echo $class->getUid();
    echo "<br/>";
    var_dump($class->getInfo());
} catch (Exception $e) {
    echo $e->getMessage(), "\n";
}