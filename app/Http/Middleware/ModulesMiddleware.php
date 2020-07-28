<?php

namespace App\Http\Middleware;

use App\Helpers\ModuleHelper;
use App\Helpers\Responses\HttpResponse;
use App\Models\Status;
use Closure;
use Illuminate\Http\Request;

class ModulesMiddleware
{
    use HttpResponse;

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
        if ($request->is(ModuleHelper::requestPatterns())) {
            return $next($request);
        }
        $status = 403;
        $title = config('api.module_disabled_message');
        $response = $this->status($status)->title($title)->get();
        return response($response, $status);
    }
}
