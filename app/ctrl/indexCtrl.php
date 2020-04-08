<?php
namespace app\ctrl;
use core\lib\model;

class indexCtrl extends \core\frag
{
    public function index()
    {
//        p('it is index');
//        $model = new \core\lib\model();
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
