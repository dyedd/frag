<?php
namespace app;

use frag\view;

class index extends view
{
    public function index()
    {
        $data = 'HELLO WORLD! frag';
        $this->assign('data', $data);
        $this->display('index.twig');
    }
}