<?php
/**
 * 入口文件
 */
use core\frag;

// 定义根目录
define('FRAG', __DIR__ . '/../');
// 核心文件
define('CORE', FRAG.'core');
// 模块路径
define('APP', FRAG.'app');
// 模块名称
define('MODULE', 'app');
//模板名称
define('THEME_NAME', 'default');
// 是否开启DEBUG
define('DEBUG', true);
// composer引用自动加载
include FRAG ."vendor/autoload.php";

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
include CORE . '/frag.php';
// 自动加载类库
spl_autoload_register("\\core\\frag::load");
// 初始化
frag::run();