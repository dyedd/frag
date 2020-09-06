<?php

/**
 * 打印
 * @param $var
 */
function p($var)
{
    echo '<pre>';
    var_dump($var);
    echo '</pre>';
}

/**
 * 绝对路径
 */
function rel()
{
    $count = substr_count($_SERVER['REQUEST_URI'], '/') - 1;
    $str = '';
    for ($i = 1; $i < $count; $i++) {
        $str .= '../';
    }
    return rtrim($str, '/');
}

/**
 * 消息提示json封装
 * @param array $arr
 * @return false|string
 */
function showMsg($arr)
{
    return json_encode($arr, JSON_UNESCAPED_UNICODE);
}

/**
 * 展开提示
 * @param string $val
 * @return mixed
 */
function unfoldMSg($val)
{
    return json_decode($val, true);
}