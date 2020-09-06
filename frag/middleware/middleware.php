<?php
namespace frag\middleware;
use Closure;

class middleware extends \frag\lib\middleware
{
    public function handle($request, Closure $next)
    {
        // echo "Start SimpleMiddleware\n";
        $response = $next($request);
        // echo "End SimpleMiddleware\n";
        return $response;
    }
}