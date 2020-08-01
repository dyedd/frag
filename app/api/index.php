<?php
namespace app\api;

use frag\init;

class index extends init
{
    public function index()
    {
        $data = 'HELLO WORLD! twig';
        $this->assign('data', $data);
        $this->display('index.twig');
    }
}