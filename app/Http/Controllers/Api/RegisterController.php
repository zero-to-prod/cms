<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Middleware\ApiCanRegister;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
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
        /** @todo Make ApiHelpers for the below values. */
        $name_max_length     = config('api.name_max_length');
        $name_min_length     = config('api.name_min_length');
        $password_max_length = config('api.password_max_length');
        $password_min_length = config('api.password_min_length');
        $email_max_length    = config('api.email_max_length');
        $request->validate(
            [
                'name'     => ['required', 'string', "max:$name_max_length", "min:$name_min_length"],
                'email'    => ['required', 'string', 'email', "max:$email_max_length", 'unique:users'],
                'password' => ['required', 'string', "min:$password_min_length", "max:$password_max_length"],
            ]
        );

        $user           = new User();
        $user->name     = $request->name;
        $user->email    = $request->email;
        $user->password = Hash::make($request->password);
        $user->save();

        $status   = 200;
        $title    = config('api.user_registered_message');
        $response = $this->title($title)->status($status)->data($user)->get();

        return response($response, $status);
    }
}
