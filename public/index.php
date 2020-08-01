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
$files = [];
getAllFiles(APP, $files);
foreach ($files as $file){
    if (strstr($file, 'untils.php') or strstr($file, 'route.php')){
        include $file;
    }
}

// 中间件的使用

$middlewares = \frag\lib\conf::all('middleware');

$next = function ($request) {
    // 初始化
    return route::dispatch();
};
foreach ($middlewares as $middleware) {
    $next = function ($request) use ($next, $middleware) {
        return (new $middleware)->handle($request, $next);
    };
}
echo $next('request');