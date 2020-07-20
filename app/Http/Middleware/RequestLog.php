<?php

namespace App\Http\Middleware;

use App\Events\RequestLog as RequestLogEvent;
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
        if (config('app.REQUEST_LOG_ENABLED') === '1') {
            event(new RequestLogEvent($request, $next($request)));
        }

        return $next($request);
    }
}
