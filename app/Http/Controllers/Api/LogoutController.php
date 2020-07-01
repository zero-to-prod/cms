<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class LogoutController
{
    /**
     * @param  Request  $request
     *
     * @return JsonResponse
     */
    public function __invoke(Request $request)
    {
        auth()->user()->tokens()->each(static function ($token, $key) {
            $token->delete();
        });

        return response()->json('Logged out successfully.', 200);
    }
}