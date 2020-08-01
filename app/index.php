<?php
namespace app;

use frag\init;

class index extends init
{
    public function index()
    {
        $data = 'HELLO WORLD! frag';
        $this->assign('data', $data);
        $this->display('index.twig');
    }
}