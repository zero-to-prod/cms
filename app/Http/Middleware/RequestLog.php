<?php

namespace App\Http\Middleware;

use App\Events\RequestLogEvent;
use App\Helpers\AppHelper;
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
        if (AppHelper::requestLogEnabled()) {
            event(new RequestLogEvent($request, $response));
        }

        return $response;
    }
}
