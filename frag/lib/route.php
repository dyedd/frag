<?php
namespace frag\lib;
use FastRoute\Dispatcher;

class route
{
    public static $dispatcher;
    public static $controller;
    public static $action;
    /**
     * 路由配置
     * @throws \Exception
     */
    public static function dispatch()
    {
        // 获取请求的方法和 URI
        $httpMethod = $_SERVER['REQUEST_METHOD'];
        $uri = $_SERVER['REQUEST_URI'];

        // 去除查询字符串( ? 后面的内容) 和 解码 URI
        if (false !== $pos = strpos($uri, '?')) {
            $uri = substr($uri, 0, $pos);
        }
        $uri = rawurldecode($uri);
        $repUri = implode('/', array_intersect(explode( '\\', APP), explode('/', $uri)));
        $uri = preg_replace('/\/'. $repUri .'/', '', $uri);
        $routeInfo = self::$dispatcher->dispatch($httpMethod, $uri);
        switch ($routeInfo[0]) {
            case Dispatcher::NOT_FOUND:  //找不到路由
                throw new \Exception('找不到路由');
            case Dispatcher::METHOD_NOT_ALLOWED:
                throw new \Exception('请求错误,应该是' . $routeInfo[1]);
            case Dispatcher::FOUND:  //找到路由
                $handler = $routeInfo[1];
                $vars = $routeInfo[2];
                $part = explode('@',$handler);
                self::$controller = new $part[0]();
                self::$action = $part[1];
                self::$controller->{self::$action}($vars);
                break;
        }
    }
}
