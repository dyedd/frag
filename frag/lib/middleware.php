<?php
namespace frag\lib;
// 中间件
use Closure;

class middleware
{
    public function handle($request, Closure $next)
    {
        return $next($request);
    }
}