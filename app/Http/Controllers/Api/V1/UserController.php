<?php

namespace App\Http\Controllers\Api\V1;

use App\Helpers\UserHelper;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class UserController extends Controller
{
    /**
     * @param  Request  $request
     *
     * @return Application|ResponseFactory|Response
     */
    public function __invoke(Request $request)
    {
        /** @todo make a sub query for last_login. */
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
                    'last_login' => UserHelper::lastLogin($user->id, 1)
                ]
            )->get();

        return response($response, $status);
    }
}
