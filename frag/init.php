<?php

namespace frag;
use frag\lib\conf;
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
    //路由变量
    public static $route;
    
    /**
     * @throws \Exception
     */
    public static function run()
    {
        //数据库初始化
        self::$db = new model();
        // 实例化路由类
        self::$route = new lib\route();

        $ctrl = self::$route->ctrl;
        $action = self::$route->action;
        // 由路由找到模块
        $dir = ROOT . '/app/' . $ctrl;
        if (is_dir($dir)){
            if (is_file($dir . '/ctrl.php')){
                $ctrlClass = "\\app\\" . $ctrl . "\\ctrl";
                $ctrl = new $ctrlClass;
                $ctrl->$action();
            }else{
                throw new \Exception( '找不到[' . $action . ']控制器');
            }
        }else{
            throw new \Exception($ctrl . '模块不存在');
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
        //对于数组
        if (is_array($value)){
            foreach ($value as $detail){
                //对于套娃数组
                if (is_array($detail)){
                    $this->assignArr[] = $detail;
                    $this->assign[$name] = $this->assignArr;
                    //循环后清空数组存缓
                    $this->assignArr = [];
                }else{
                    break;
                }
            }
            //也是数组.实际等于上面foreach循环后的
            $this->assign[$name] = $value;
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
    $file = ROOT . '/public/tpl/' . $file;
    if (is_file($file)){
        $pathCache = ROOT .'/public/cache/twig';
        $loader = new \Twig\Loader\FilesystemLoader(ROOT. '/public/tpl');
        $twig = new \Twig\Environment($loader, [
            'cache' => $pathCache,
            'debug' => 'DEBUG'
        ]);
        $template = $twig->load($tempFile);
        if (!empty(self::$route->relativePath))
            $this->assign('RELADIR', rtrim(self::$route->relativePath, '/'));
        $template->display($this->assign);
        }
    }
}