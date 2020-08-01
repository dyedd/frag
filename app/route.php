<?php
use frag\lib\route;
route::get('index/(:num)', function ($i){echo $i;});
route::get('index', 'app\index@index');
