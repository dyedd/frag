<?php
namespace app\ctrl;
use frag\lib\model;

class indexCtrl extends \frag\init
{
    public function index()
    {
//        p('it is index');
//        $model = new \frag\lib\model();
//        $sql = "SELECT * FROM test_a";
//        $ret = $model->query($sql);
//        p($ret->fetch());
        $model = new model();
//        $data = $model->select("test_a", "*");
//        p($data);

        $data = 'HELLO WORLD! twig';
        $this->assign('data', $data);
        $this->display('index.html');
    }
    public function test()
    {
        $data = 'test';
        $this->assign('data', $data);
        $this->display('test.html');
    }
}
