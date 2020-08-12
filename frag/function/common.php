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