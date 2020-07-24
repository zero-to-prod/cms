<?php

namespace App\Http\Controllers\Api;

use App\Events\ApiLoginEvent;
use App\Helpers\ApiHelper;
use App\Helpers\UserHelper;
use App\Http\Controllers\Controller;
use App\Http\Middleware\ApiCanLogin;
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
     * @see LoginControllerTest::api_can_get_access_and_refresh_token()
     */
    public function __invoke(Request $request)
    {
        $http = new Client();
        try {
            $response = $http->post('http://cms.test/oauth/token', [
                'form_params' => [
                    'grant_type'    => 'password',
                    'client_id'     => $request->client_id,
                    'client_secret' => $request->client_secret,
                    'username'      => $request->email,
                    'password'      => $request->password,
                ],
            ]);

            if (ApiHelper::authLogEnabled()) {
                $user = UserHelper::fromEmail($request->email);
                event(new ApiLoginEvent($user, $request));
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
