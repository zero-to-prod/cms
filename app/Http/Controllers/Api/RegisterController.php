<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class RegisterController
{
    /**
     * @param  Request  $request
     *
     * @return mixed
     */
    public function __invoke(Request $request)
    {
        $request->validate([
            'email'    => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'max:255'],
        ]);

        return User::create([
            'email'    => $request->email,
            'password' => Hash::make($request->password),
        ]);
    }
}
