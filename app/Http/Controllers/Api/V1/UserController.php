<?php

namespace App\Http\Controllers\Api\V1;

use App\Cache\User\CacheUserAuth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Response;

class UserController extends Controller
{
    public function __invoke(Response $response)
    {
        return response(auth()->user(), 200);
    }
}
