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
        self::$url = preg_replace('/\?.*[|\/]*/', '', $url);
        $pathArr = conf::get('PATH', 'urls');
        if (array_key_exists(self::$url, $pathArr)) {
            $func = substr($pathArr[self::$url], strpos($pathArr[self::$url], '.')+1);
            $class = substr($pathArr[self::$url], 0, strpos($pathArr[self::$url], '.'));
            self::$ctrl = new $class;
            self::$ctrl->$func();
        }else{
            throw new Exception('找不到' . $pathArr[self::$url] . '相关路径');
        }
    }

}