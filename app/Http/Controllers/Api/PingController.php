<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Http\Response;
use Tests\Routes\Api\V1\PingTest;

class PingController extends Controller
{
    /**
     * @return Application|ResponseFactory|Response
     * @see PingTest::ping()
     */
    public function __invoke()
    {
        $status   = 200;
        $response = $this->title(config('api.ping_response'))->status($status)->get();

        return response($response, $status);
    }
}
