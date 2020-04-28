<?php
namespace frag\lib;
class conf
{
    public static $conf = array();

    /**
     * 获取文件的单个设置
     * @param $name
     * @param $file
     * @return mixed
     * @throws \Exception
     */
    public static function get($name, $file)
    {
        //存缓配置
        if (isset(self::$conf[$file]))
            return self::$conf[$file][$name];
        else{
            $path = ROOT . '/config/' . $file . '.php';
            if (is_file($path)){
                $conf = include $path;
                if (isset($conf[$name])){
                    self::$conf[$file] = $conf;
                    return $conf[$name];
                }else
                    throw new \Exception('没有这个配置项' . $name);
            }else
                throw new \Exception('找不到配置文件' . $file);
        }

    }

    /**
     * 返回文件所有内容
     * @param $file
     * @return mixed
     * @throws \Exception
     */
    public static function all($file)
    {
        //存缓配置
        if (isset(self::$conf[$file]))
            return self::$conf[$file];
        else {
            $path = ROOT . '/config/' . $file . '.php';
            if (is_file($path)) {
                $conf = include $path;
                self::$conf[$file] = $conf;
                return $conf;
            } else
                throw new \Exception('找不到配置文件' . $file);
        }
    }
}
