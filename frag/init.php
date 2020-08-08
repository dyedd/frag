<?php

namespace frag;

use frag\lib\composer\model;
use Twig\Environment;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Error\SyntaxError;
use Twig\Loader\FilesystemLoader;
use frag\lib\route;

class init
{
    // 存储已经存在的引擎要用的变量
    public $assign;
    //传递数组给模板引擎
    public $assignArr = array();
    public static $db;
    public static $files = array();
    /**
     * 初始化
     * @throws \Exception
     */
    public static function go()
    {
        // 连接数据库
        self::$db = new model();
        // 分模块加载函数和路由
        getAllFiles(APP, self::$files);
        foreach (self::$files as $file){
            if (strstr($file, 'utils.php') or strstr($file, 'route.php')){
                include $file;
            }
        }
        // 中间件的使用
        $middlewares = \frag\lib\conf::all('middleware');

        $next = function ($request) {
            // 初始化
            route::dispatch();
        };
        foreach ($middlewares as $middleware) {
            $next = function ($request) use ($next, $middleware) {
                return (new $middleware)->handle($request, $next);
            };
        }
        $next('frag');

    }
    /**
     * 将值传给name，用作引擎解析的名字
     * @param $name
     * @param $value
     */
    public function assign($name, $value)
    {
        //对于数组
        if (is_array($value)) {
            foreach ($value as $detail) {
                //对于套娃数组
                if (is_array($detail)) {
                    $this->assignArr[] = $detail;
                    $this->assign[$name] = $this->assignArr;
                    //循环后清空数组存缓
                    $this->assignArr = [];
                } else {
                    break;
                }
            }
            //也是数组.实际等于上面foreach循环后的
            $this->assign[$name] = $value;
        } else $this->assign[$name] = $value;
    }

    /**
     * 加载twig引擎到这个html文件
     * @param $file
     * @throws LoaderError
     * @throws RuntimeError
     * @throws SyntaxError
     */
    public function display($file)
    {
        $tempFile = $file;
        $file = ROOT . '/public/tpl/' . $file;
        if (is_file($file)) {
            $pathCache = ROOT . '/public/cache/twig';
            $loader = new FilesystemLoader(ROOT . '/public/tpl');
            $twig = new Environment($loader, [
                'cache' => $pathCache,
                'debug' => 'DEBUG'
            ]);
            $template = $twig->load($tempFile);
            $this->assign('basedir', rel() );
            $template->display($this->assign);
        }
    }
}