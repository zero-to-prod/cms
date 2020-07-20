<?php

namespace App\Http\Controllers\Api\V1;

use App\Cache\User\CacheAuthLog;
use App\Http\Controllers\Controller;
use App\Models\AuthLog;
use Illuminate\Http\Response;

class AuthLogController extends Controller
{
    public function __invoke(Response $response)
    {
        return response(CacheAuthLog::get()->take(10), 200);
    }
}
