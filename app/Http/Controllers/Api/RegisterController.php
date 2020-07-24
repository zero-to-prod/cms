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
     * @see RegisterControllerTest::nameIsRequired()
     * @see RegisterControllerTest::nameIsString()
     * @see RegisterControllerTest::nameMax()
     * @see RegisterControllerTest::emailIsRequired()
     * @see RegisterControllerTest::passwordIsRequired()
     */
    public function __invoke(Request $request)
    {
        $name_length = config('api.name_length');
        $request->validate([
            'name'     => ['required', 'string', "max:$name_length", 'min:2'],
            'email'    => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'max:255'],
        ]);

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
