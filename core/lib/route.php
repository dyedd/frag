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
            // 匹配index/index 去除？n = 1
            if (preg_match('/(\?|&.*)/', $rePath))
                $rePath = preg_replace('/(\?|&.*)/', '', $rePath);
            $pathArr = explode("/",$rePath);
            if (!empty($pathArr[0]))
                $this->ctrl = $pathArr[0];
            if (!empty($pathArr[1]))
               $this->action = $pathArr[1];
            else
               $this->action = conf::get('ACTION', 'route');
        }else{
            $this->ctrl = conf::get('CTRL', 'route');
            $this->action = conf::get('ACTION', 'route');
        }
    }

}