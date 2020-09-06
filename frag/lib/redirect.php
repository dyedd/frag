<?php

namespace frag\lib;
/*
 * 重定向
 */

class redirect
{
    public static function go($order = null)
    {
        if ($order == 'back') {
            header('location: ' . $_SERVER['HTTP_REFERER']);
            die();
        } else {
            header('location:' . rel() . $order);
            die();
        }
    }

}