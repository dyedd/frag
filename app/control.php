<?php
namespace app;

use frag\init;

class control extends init
{
    public function showIndex()
    {
        $data = 'HELLO WORLD! twig';
        $this->assign('data', $data);
        $this->display('index.twig');
    }
}