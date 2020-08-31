<?php

use FastRoute\RouteCollector;
use frag\lib\route;
use function FastRoute\simpleDispatcher;

return route::$dispatcher = simpleDispatcher(function(RouteCollector $route) {
    $route->addGroup('/index', function (RouteCollector $route) {
        $route->addRoute(['GET', 'POST'], '/index', 'app\index@index');
    });
}, [
    'cacheFile' => APP . '/public/cache/route.cache'
]);
