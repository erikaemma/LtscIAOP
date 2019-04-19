<?php

require_once dirname(__DIR__) . DIRECTORY_SEPARATOR .'src' . DIRECTORY_SEPARATOR . 'AOP.php';

require_once './demo/Logger.php';
require_once './demo/Auth.php';
require_once './demo/App.php';

class AopTest extends \PHPUnit\Framework\TestCase
{
    public function testAop() {
        $proxy = new LTSC\AOP\AOP(new App());
        $proxy->addBefore(function () {
            $auth = new Auth();
            return $auth->isLogin();
        });
        $proxy->addAfter(function ($r, $m, $a){
            Logger::log("OK\n");
            echo $r;
            return true;
        });
        $proxy->sayHello("You");
    }
}