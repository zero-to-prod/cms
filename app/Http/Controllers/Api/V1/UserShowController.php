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

class UserShowController extends Controller
{
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
                    'last_login' => User::secondToLastLogin($user->id),
                    'scopes'     => User::scopesAsArray($user->email)
                ]
            )->get();

        return response($response, $status);
    }
}
