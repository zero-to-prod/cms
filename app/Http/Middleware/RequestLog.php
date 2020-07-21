<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class RequestLog
{
    /**
     * Handle an incoming request.
     *
     * @param  Request  $request
     * @param  Closure  $next
     *
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $response = $next($request);
        if (config('app.REQUEST_LOG_ENABLED') === '1') {
            event(new \App\Events\RequestLog($request, $response));
        }

        return $response;
    }
}
