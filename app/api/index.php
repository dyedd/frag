<?php
namespace app\api;

use frag\view;

class index extends view
{
    public function index()
    {
        $data = 'HELLO WORLD! twig';
        $this->assign('data', $data);
        $this->display('index.twig');
    }
}