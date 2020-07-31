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
/*
 * 输出目录所有的文件和目录
 */
function getAllFiles($path,&$files)
{
    if (is_dir($path)) {
        $dp = dir($path);
        while ($file = $dp->read()) {
            if ($file != "." && $file != "..") {
                getAllFiles($path . "/" . $file, $files);
            }
        }
        $dp->close();
    }
    if (is_file($path)) {
        $files[] = $path;
    }
    return $files;
}
