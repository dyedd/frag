<?php
/**
 * 入口文件
 */
use frag\init;

// 定义根目录
define('ROOT', __DIR__ . '/..');
// 核心文件
define('CORE', ROOT.'/frag');
// 模块路径
define('APP', ROOT.'/app');
// 模块名称
define('MODULE', 'app');
// 扩展模块
define('MULTI_MODULE', 'api,');
// 是否开启DEBUG
define('DEBUG', true);
// composer引用自动加载
include ROOT .'/vendor/autoload.php';

if (DEBUG) {
    // whoops错误提示
    $whoops = new \Whoops\Run;
    $errorTitle = '框架出错了';
    $option = new \Whoops\Handler\PrettyPageHandler();
    $option->setPageTitle($errorTitle);
    $whoops->pushHandler($option);
    $whoops->register();
}

// 公共函数
include CORE . '/function/common.php';
// 核心文件
include CORE . '/init.php';
// 自动加载类库
spl_autoload_register('\\frag\\init::load');
// 初始化
init::run();