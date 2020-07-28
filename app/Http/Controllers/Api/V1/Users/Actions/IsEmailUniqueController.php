<?php

namespace App\Http\Controllers\Api\V1\Users\Actions;

use App\Models\User;
use CloudCreativity\LaravelJsonApi\Http\Controllers\JsonApiController;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class IsEmailUniqueController extends JsonApiController
{
    /**
     * Determines if an email is unique.
     *
     * @param  Request  $request
     *
     * @return Application|ResponseFactory|Response
     * @see IsEmailUniqueTest
     */
    public function __invoke(Request $request)
    {
        $email = User::where('email', $request->email)->first();
        if ($email !== null) {
            return response([
                'email'     => $request->email,
                'is_unique' => false,
            ], 200);
        }

        return response([
            'email'     => $request->email,
            'is_unique' => true,
        ], 200);
    }
}
