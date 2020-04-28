<?php
namespace frag\lib;
use frag\lib\conf;
class log
{
    public static $class;

    /**
     * 初始化日志
     * @throws \Exception
     */
    public static function init()
    {
        //确定存储方式
        $drive = conf::get('DRIVE', 'log');
        $class = "\\frag\\lib\\drive\\log\\" . $drive;
        self::$class = new $class;
    }

    /**
     * 记录日志
     * @param $name
     * @param string $file
     */
    public static function log($name, $file = 'log')
    {
        self::$class->log($name, $file);
    }
}
