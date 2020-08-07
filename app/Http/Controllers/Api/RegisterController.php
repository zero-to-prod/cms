<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Middleware\ApiCanRegister;
use App\Models\User;
use Illuminate\Http\Request;
use Tests\Routes\Api\V1\RegisterControllerTest;

class RegisterController extends Controller
{
    /**
     * RegisterController constructor.
     */
    public function __construct()
    {
        $this->middleware(ApiCanRegister::class);
    }

    /**
     * @param  Request  $request
     *
     * @return mixed
     * @see RegisterControllerTest
     */
    public function __invoke(Request $request)
    {
        User::validateRequest($request);

        $user = User::match(
            [
                'name'     => $request->name,
                'email'    => $request->email,
                'password' => $request->password,
                'locale'   => $request->user_locale
            ],
            true
        );

        $status   = 200;
        $title    = config('api.user_registered_message');
        $response = $this->title($title)->status($status)->data($user)->get();

        return response($response, $status);
    }
}
