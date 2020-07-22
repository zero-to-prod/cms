<?php

namespace App\Http\Middleware;

use App\Helpers\Classes\ApiHelper;
use App\Helpers\Responses\HttpResponse;
use Closure;
use Illuminate\Http\Request;

class ApiCanLogin
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
        if (ApiHelper::cannotLogin()) {
            $http_code = 401;
            $response  = $this->status($http_code)
                ->title(config('api.can_login_denied_message'))
                ->get();

            return response(['errors' => [$response]], $http_code);
        }

        return $next($request);
    }
}
