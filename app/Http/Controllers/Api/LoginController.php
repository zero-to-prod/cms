<?php

namespace App\Http\Controllers\Api;

use App\Events\LogApiLogin;
use App\Http\Controllers\Controller;
use App\Http\Middleware\ApiCanLogin;
use App\Models\User;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\BadResponseException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Psr\Http\Message\StreamInterface;

class LoginController extends Controller
{

    public function __construct()
    {
        $this->middleware(ApiCanLogin::class);
    }

    /**
     * @param  Request  $request
     *
     * @return JsonResponse|StreamInterface
     */
    public function __invoke(Request $request)
    {
        $http = new Client;
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

            if (config('api.API_AUTH_LOG_ENABLED')) {
                $user = User::where('email', $request->email)->first();
                event(new LogApiLogin($user, $request));
            }

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
