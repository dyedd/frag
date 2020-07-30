<?php
/**
 * 入口文件
 */



// 定义根目录
use frag\lib\route;
use Whoops\Handler\PrettyPageHandler;
use Whoops\Run;

define('ROOT', dirname(__DIR__));
// 核心文件
define('CORE', ROOT.'/frag');
// 是否开启DEBUG
define('DEBUG', true);
// composer引用自动加载
include ROOT .'/vendor/autoload.php';

if (DEBUG) {
    // whoops错误提示
    $whoops = new Run;
    $errorTitle = '框架出错了';
    $option = new PrettyPageHandler();
    $option->setPageTitle($errorTitle);
    $whoops->pushHandler($option);
    $whoops->register();
}
// 初始化
route::run();