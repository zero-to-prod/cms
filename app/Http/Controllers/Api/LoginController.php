<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\BadResponseException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Psr\Http\Message\StreamInterface;

class LoginController
{
    /**
     * @param  Request  $request
     *
     * @return JsonResponse|StreamInterface
     */
    public function __invoke(Request $request)
    {
        $http = new Client;
        // $user = User::where('email', $request->username)->first();
        // if($user->email_verified_at === null){
        //     return response()->json('Email not verified', 401);
        // }
        try {
            $response = $http->post(config('oauth.uri_token'), [
                'form_params' => [
                    'grant_type'    => 'password',
                    'client_id'     => $request->client_id,
                    'client_secret' => $request->client_secret,
                    'username'      => $request->email,
                    'password'      => $request->password,
                ],
            ]);

            return $response->getBody();
        } catch (BadResponseException $e) {
            if ($e->getCode() === 400) {
                return response()->json('Invalid Request. Please enter a username or a password.', $e->getCode());
            }

            if ($e->getCode() === 401) {
                return response()->json('Your credentials are incorrect. Please try again', $e->getCode());
            }

            return response()->json('Something went wrong on the server.', $e->getCode());
        }
    }
}
