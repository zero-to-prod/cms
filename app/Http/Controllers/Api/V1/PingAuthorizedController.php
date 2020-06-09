<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use Tests\Uri\V1\PingAuthorizedTest;

class PingAuthorizedController extends Controller
{

    /** @see PingAuthorizedTest */
    public function __invoke()
    {
        return response(config('api.ping_response'), 200);
    }
}
