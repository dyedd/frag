<?php

use FastRoute\RouteCollector;
use frag\lib\route;
use function FastRoute\simpleDispatcher;

return route::$dispatcher = simpleDispatcher(function(RouteCollector $route) {
    $route->addGroup('/api/admin', function (RouteCollector $route) {
        $route->addRoute(['GET', 'POST'], '/compose', 'app\api\admin@compose');
        $route->addRoute(['GET', 'POST'], '/user', 'app\api\admin@user');
    });
    $route->addGroup('/api/compose', function (RouteCollector $route) {
        $route->addRoute(['GET', 'POST'], '/commentSubmit', 'app\api\compose@commentSubmit');
        $route->addRoute(['GET', 'POST'], '/comment', 'app\api\compose@comment');
        $route->addRoute(['GET', 'POST'], '/floor', 'app\api\compose@floor');
        $route->addRoute(['GET', 'POST'], '/get', 'app\api\compose@get');
    });
    $route->addGroup('/api/user', function (RouteCollector $route) {
        $route->addRoute(['GET', 'POST'], '/login', 'app\api\user@login');
        $route->addRoute(['GET', 'POST'], '/avatar', 'app\api\user@avatar');
        $route->addRoute(['GET', 'POST'], '/account', 'app\api\user@account');
        $route->addRoute(['GET', 'POST'], '/follow', 'app\api\user@follow');
        $route->addRoute(['GET', 'POST'], '/getFollower', 'app\api\user@getFollower');
        $route->addRoute(['GET', 'POST'], '/getFansList', 'app\api\user@getFansList');
    });
    $route->addGroup('/api/writer', function (RouteCollector $route) {
        $route->addRoute(['GET', 'POST'], '/imagesUp', 'app\api\writer@imagesUp');
        $route->addRoute(['GET', 'POST'], '/post', 'app\api\writer@post');

    });
    $route->addGroup('/admin', function (RouteCollector $route) {
        $route->addRoute(['GET', 'POST'], '/index', 'app\admin@index');
        $route->addRoute(['GET', 'POST'], '/settings', 'app\admin@settings');
        $route->addRoute(['GET', 'POST'], '/user', 'app\admin@user');
        $route->addRoute(['GET', 'POST'], '/usercredits', 'app\admin@usercredits');
        $route->addRoute(['GET', 'POST'], '/backteam', 'app\admin@backteam');
        $route->addRoute(['GET', 'POST'], '/login', 'app\admin@login');
        $route->addRoute(['GET', 'POST'], '/logout', 'app\admin@logout');
        $route->addRoute(['GET', 'POST'], '/compose', 'app\admin@compose');
    });
    $route->addGroup('/compose', function (RouteCollector $route) {
        $route->addRoute(['GET', 'POST'], '', 'app\compose@index');
        $route->addRoute(['GET', 'POST'], '/article/{aid}', 'app\compose@article');
    });
    $route->addRoute(['GET', 'POST'], '/login', 'app\login@index');
    $route->addRoute(['GET', 'POST'], '/logout', 'app\logout@index');
    $route->addGroup('/user', function (RouteCollector $route) {
        $route->addRoute(['GET', 'POST'], '/space/{id:\d+}', 'app\user@space');
        $route->addRoute(['GET', 'POST'], '/article/{aid}', 'app\user@article');
        $route->addRoute(['GET', 'POST'], '/home', 'app\user@home');
        $route->addRoute(['GET', 'POST'], '/face', 'app\user@face');
        $route->addRoute(['GET', 'POST'], '/account', 'app\user@account');
        $route->addRoute(['GET', 'POST'], '/follower', 'app\user@follower');
        $route->addRoute(['GET', 'POST'], '/fans', 'app\user@fans');
    });
    $route->addGroup('/writer', function (RouteCollector $route) {
        $route->addRoute(['GET', 'POST'], '/index', 'app\writer@index');
        $route->addRoute(['GET', 'POST'], '/compose', 'app\writer@compose');
        $route->addRoute(['GET', 'POST'], '/manage/{page:\d+}[/{group}]', 'app\writer@compose');
    });
}, [
    'cacheFile' => APP . '/public/cache/route.cache'
]);
