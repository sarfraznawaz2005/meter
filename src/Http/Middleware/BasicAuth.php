<?php

namespace Sarfraznawaz2005\Meter\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class BasicAuth
{
    /**
     * Handle an incoming request.
     *
     * @param  Request $request
     * @param Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $AUTH_USER = config('meter.username');
        $AUTH_PASS = config('meter.password');

        header('Cache-Control: no-cache, must-revalidate, max-age=0');

        $hasSuppliedCredentials = !(empty($_SERVER['PHP_AUTH_USER']) && empty($_SERVER['PHP_AUTH_PW']));

        $isNotAuthenticated = (
            !$hasSuppliedCredentials ||
            $_SERVER['PHP_AUTH_USER'] != $AUTH_USER ||
            $_SERVER['PHP_AUTH_PW'] != $AUTH_PASS
        );

        if ($isNotAuthenticated) {
            header('HTTP/1.1 401 Authorization Required');
            header('WWW-Authenticate: Basic realm="Access Denied"');
            exit;
        }

        return $next($request);
    }
}
