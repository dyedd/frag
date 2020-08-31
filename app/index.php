<?php
namespace app;

use frag\init;

class index extends init
{
    public function index()
    {
        $data = 'HELLO WORLD! frag';
        $this->assign('data', $data);
        p($_SERVER['CONTENT_TYPE']);
        p($_SERVER['HTTP_ACCEPT']);
        $this->display('index.twig');
    }
}