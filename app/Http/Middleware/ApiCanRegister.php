<?php

namespace App\Http\Middleware;

use App\Helpers\Responses\HttpResponse;
use Closure;
use Illuminate\Http\Request;

class ApiCanRegister
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
        if (config('api.API_CAN_REGISTER') !== '1') {
            $http_code = 401;
            $response = $this->status($http_code)
                ->title(config('api.can_register_denied_message'))
                ->get();

            return response($response, $http_code);
        }

        return $next($request);
    }
}
