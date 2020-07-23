<?php

namespace App\Http\Controllers\Api;

use App\Events\ApiLogoutEvent;
use App\Http\Controllers\Controller;
use App\Models\AuthLog;
use App\Models\User;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class LogoutController extends Controller
{

    /**
     * @param  Request  $request
     *
     * @return Application|ResponseFactory|Response
     */
    public function __invoke(Request $request)
    {
        $user = auth()->user();
        auth()->user()->tokens()->each(static function ($token, $key) {
            $token->delete();
        });
        event(new ApiLogoutEvent($user, $request));

        $auth_log     = AuthLog::where('user_id', $user->id)->with('user')->latest()->first();
        $title    = config('api.logout_message');
        $status   = 200;
        $response = $this->title($title)->status($status)->data($auth_log)->get();

        return response($response, $status);
    }
}
