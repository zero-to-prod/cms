<?php

namespace App\Http\Controllers\Api\V1;

use App\Helpers\UserHelper;
use App\Http\Controllers\Controller;
use App\Http\Middleware\ModulesMiddleware;
use App\Models\User;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class UserController extends Controller
{

    public function __construct()
    {
        $this->middleware(ModulesMiddleware::class);
    }

    /**
     * @param  Request  $request
     *
     * @return Application|ResponseFactory|Response
     */
    public function __invoke(Request $request)
    {
        /**
         * @todo Make a sub query for last_login.
         * @todo Make test.
         */
        $user = User::where('id', auth()->user()->id)->with(
            [
                'contact',
                'meta',
            ]
        )->first();

        $status   = 200;
        $response = $this->title('User')
            ->status($status)
            ->data(
                [
                    'user'       => $user,
                    'last_login' => UserHelper::lastLogin($user->id, 1) ?? UserHelper::lastLogin($user->id)
                ]
            )->get();

        return response($response, $status);
    }
}
