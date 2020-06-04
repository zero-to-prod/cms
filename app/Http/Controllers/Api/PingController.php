<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;

class PingController extends Controller
{
    public function __invoke()
    {
        return response(config('api.ping_response'), 200);
    }
}
