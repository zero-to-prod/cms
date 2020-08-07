<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\AuthLog;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

class AuthLogController extends Controller
{
    /**
     * @param  Response  $response
     *
     * @return Application|ResponseFactory|Response
     */
    public function __invoke(Response $response)
    {
        /** @todo Make test. */
        $data = AuthLog::where('user_id', Auth::user()->id)->orderBy('created_at', 'DESC')->limit(10)->get(
            ['login', 'created_at', 'ip_address', 'user_agent']
        );

        return response($data, 200);
    }
}
