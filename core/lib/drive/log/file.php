<?php
namespace core\lib\drive\log;
//文件系统
use core\lib\conf;

class file
{
    // 日志存储位置
    public $path;
    public function __construct()
    {
        $conf =  conf::get('OPTION', 'log');
        $this->path = $conf['PATH'];
    }

    /**
     * 记录日志
     * @param $message
     * @param string $file
     * @return false|int
     */
    public function log($message, $file = 'log')
    {
        if (!is_dir($this->path . date('YmdH')))
            mkdir($this->path . date('YmdH'), 0777, true);
        $message = date('Y-m-d H:i:s') . json_encode($message, JSON_UNESCAPED_UNICODE) . PHP_EOL;
        return file_put_contents($this->path . date('YmdH') . '/' . $file . '.txt', $message, FILE_APPEND);
    }
}
