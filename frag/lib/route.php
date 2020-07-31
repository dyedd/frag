<?php
namespace frag\lib;
use Exception;

class route
{
    public static $url;
    public static $ctrl;
    /**
     * route constructor.
     * @throws Exception
     */
    public static function run()
    {
        $trimUrl = rtrim($_SERVER['REQUEST_URI'], '/');
        // 重复的路径
        $path = implode('/', array_intersect(explode( '\\', ROOT), explode('/', $trimUrl)));
        $url = preg_replace('/\/'. $path .'\//', '', $trimUrl);
        // 去掉？
        $url = preg_replace('/\?.*[|\/]*/', '', $url);
        $urlArr = explode('/', $url);
        if (is_dir(APP . '/' . 'control')) {
            // 多应用
            if (is_dir(APP . '/' .$urlArr[0])){
                $class = '\\app\\' . $urlArr[0] . '\\' . $urlArr[1];
                $class = new $class;
                $action = $urlArr[2];
                $class->$action();
            }else{
                throw new Exception('没有创建应用' . $urlArr[0]);
            }
        }else{
            // 单应用
            $class = '\\app\\' . $urlArr[0];
            $class = new $class;
            $action = $urlArr[1];
            $class->$action();
        }
    }

}