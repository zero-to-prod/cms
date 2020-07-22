<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Response;

class UserController extends Controller
{
    public function __invoke(Response $response)
    {
        $user = User::where('id', auth()->user()->id)->with([
            'contact', 'auth_log', 'request_log', 'meta'
        ])->first();

        return response($user, 200);
    }
}
