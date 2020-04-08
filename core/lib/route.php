<?php
namespace core\lib;
use core\lib\conf;
class route
{
    public $ctrl;
    public $action;

    /**
     * route constructor.
     * @throws \Exception
     */
    public function __construct()
    {
        // xxx.com/index.php/index/index
        // xxx.com/xx/index.php/index/index
        if (isset($_SERVER['QUERY_STRING']) && $_SERVER['QUERY_STRING'] != ""){
            $path = $_SERVER['QUERY_STRING'];
            $rePath = trim($path,"s=");
            $pathArr = explode("/",$rePath);
            if (!empty($pathArr[0]))
                $this->ctrl = $pathArr[0];
            if (!empty($pathArr[1]))
               $this->action = $pathArr[1];
            else
               $this->action = conf::get('ACTION', 'route');
            // url 多余部分转换成 GET
            // index/index/id/q
            unset($pathArr[0]);
            unset($pathArr[1]);
            // 重置索引
            $pathArr = &array_values($pathArr);
            $count = count($pathArr);
            if ($count > 2)
                foreach ($pathArr as $key => $value)
                    if ($key % 2 == 0){
                        // 提供get与post
                        $_GET[$pathArr[$key]] = $pathArr[$key + 1];

                        $_POST[$pathArr[$key]] = $pathArr[$key + 1];
                    }
        }else{
            $this->ctrl = conf::get('CTRL', 'route');
            $this->action = conf::get('ACTION', 'route');
        }
    }

}