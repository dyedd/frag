<?php
namespace app\index;
class indexCtrl extends \frag\init
{
    public function index()
    {
        $data = 'HELLO WORLD! twig';
        $this->assign('data', $data);
        $this->display('index.html');
    }
}
