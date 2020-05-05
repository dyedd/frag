<?php
namespace frag\lib;
use frag\lib\conf;
class route
{
    public $ctrl;
    public $action;
    public $siteUrl;
    /**
     * route constructor.
     * @throws \Exception
     */
    public function __construct()
    {
        // xxx.com/index.php/index/index
        // xxx.com/xx/index.php/index/index

        //判断是否存放于二级目录等中,三级四级我觉得没意思了吧，但我还是写了
        $this->siteUrl = conf::get('URL', 'route');
        $urlArr = explode('/', $this->siteUrl);
        $catalog = '/';
        if (!empty($urlArr[3])){
            //证明不在根目录
            for ($i = 3; $i < count($urlArr) && !empty($urlArr[$i]); $i++)
                $catalog .= $urlArr[$i] . '/';
        }
        if(!empty($_SERVER['REQUEST_URI'])){
            $path = $_SERVER['REQUEST_URI'];
            $rePath = ltrim($path, $catalog);
            $pathArr = explode('/', $rePath);
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