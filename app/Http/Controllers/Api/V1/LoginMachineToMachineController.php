<?php

namespace App\Http\Controllers\Api\V1;

use GuzzleHttp\Client;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Tests\Uri\V1\LoginMachineToMachineTest;

class LoginMachineToMachineController
{

    /** @param  Request  $request
     * @return Application|ResponseFactory|Response
     * @see LoginMachineToMachineTest
     */
    public function __invoke(Request $request)
    {
        $guzzle = new Client;

        $response = $guzzle->post(config('app.url').'/oauth/token', [
            'form_params' => [
                'grant_type'    => 'client_credentials',
                'client_id'     => $request->client_id,
                'client_secret' => $request->client_secret,
                'scope'         => $request->scope,
            ],
        ]);

        return json_decode((string) $response->getBody(), true)['access_token'];
    }
}