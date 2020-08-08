<?php
namespace frag\lib\composer;
use frag\lib\conf;
use Medoo\Medoo;
class model extends Medoo
{
    /**
     * 数据库 constructor.
     * @throws \Exception
     */
    public function __construct()
    {
        $option = conf::all('database');
        try {
            parent::__construct($option);
        }catch (\Exception $e){
            p($e->getMessage());
        }

    }
}
