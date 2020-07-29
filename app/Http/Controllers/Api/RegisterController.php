<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Middleware\ApiCanRegister;
use App\Models\User;
use App\Validation\ValidateUser;
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
        $request->validate(
            [
                'name'     => ValidateUser::name(),
                'email'    => ValidateUser::email(),
                'password' => ValidateUser::password(),
                'locale'   => ValidateUser::localeForRegistration()
            ]
        );

        $user           = new User();
        $user->name     = $request->name;
        $user->email    = $request->email;
        $user->password = Hash::make($request->password);
        /** @todo Make test for locale. */
        $user->locale = $request->local_default ?? config('api.locale_default');
        $user->save();

        $status   = 200;
        $title    = config('api.user_registered_message');
        $response = $this->title($title)->status($status)->data($user)->get();

        return response($response, $status);
    }
}
