<?php

namespace frag;
use frag\lib\log;
use frag\lib\model;

class init
{
    // 存储已经加载了的类库
    public static $classMap = array();
    // 存储已经存在的引擎要用的变量
    public $assign;
    //数据库初始化存储变量
    public static $db;
    //传递数组给模板引擎
    public $assignArr = array();

    /**
     * @throws \Exception
     */
    public static function run()
    {
        //数据库初始化
        self::$db = new model();
        // 日志的初始化
        // \frag\lib\log::log('日志系统');
        log::init();
        // 实例化路由类
        $route = new lib\route();

        $ctrlClass = $route->ctrl;
        $action = $route->action;
        // 由路由找到控制器
        $ctrlFile = APP. '/ctrl/' . $ctrlClass . 'Ctrl.php';
        // 确定控制器的类
        $ctrlClass = "\\" . MODULE . "\\ctrl\\" . $ctrlClass . "Ctrl";
        // 存在就实例化
        if (is_file($ctrlFile)) {
            include $ctrlFile;
            $ctrl = new $ctrlClass;
            // $action(); 是动态的，若为index，即调用类中的test方法
            $ctrl->$action();
        }else{
            throw new \Exception('找不到控制器' . $ctrlClass);
        }
    }

    /**
     * 自动加载类库
     * @param $class $class = '\frag\route'
     * @return bool
     */
    public static function load($class)
    {
        if (isset(self::$classMap[$class])){
            return true;
        }else{
            // \存在因为有命名空间在
            $class = str_replace('\\', '/', $class);
            $file = ROOT . '/' . $class . '.php';
            if (is_file($file)){
                include $file;
                self::$classMap[$class] = $class;
            }else{
                return false;
            }
        }
    }

    /**
     * 将值传给name，用作引擎解析的名字
     * @param $name
     * @param $value
     */
    public function assign($name, $value)
    {
        if (is_array($value)){
            $this->assignArr[] = $value;
            $this->assign[$name] = $this->assignArr;
        }
        else $this->assign[$name] = $value;
    }

    /**
     * 加载twig引擎到这个html文件
     * @param $file
     * @throws \Twig\Error\LoaderError
     * @throws \Twig\Error\RuntimeError
     * @throws \Twig\Error\SyntaxError
     */
    public function display($file)
    {
    $tempFile = $file;
    $file = APP . '/template/' . THEME_NAME . '/' . $file;
    if (is_file($file)){
        $pathCache = ROOT .'/log/twig';
        $loader = new \Twig\Loader\FilesystemLoader(APP. '/template/' . THEME_NAME);
        $twig = new \Twig\Environment($loader, [
            'cache' => $pathCache,
            'debug' => 'DEBUG'
        ]);
        $template = $twig->load($tempFile);
        $judgeAssign = $this->assign ? $this->assign : '';
        $template->display($judgeAssign);
        }
    }
}