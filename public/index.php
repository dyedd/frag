<?php
/**
 * 入口文件
 */

use frag\lib\route;
use Whoops\Handler\PrettyPageHandler;
use Whoops\Run;

// 定义根目录
define('ROOT', dirname(__DIR__));
// 核心文件
define('CORE', ROOT.'/frag');
// 应用文件
define('APP', ROOT.'/app');
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
// 中间件的使用
$middleware = new \frag\lib\middleware();
$middleArr = get_class_methods($middleware);
foreach ($middleArr as $value) {
    $middleware->$value();
}
// 单独的文件
$files = [];
getAllFiles(APP, $files);
foreach ($files as $file){
    if (strstr($file, 'untils.php')){
        include $file;
    }
}
// 初始化
route::run();