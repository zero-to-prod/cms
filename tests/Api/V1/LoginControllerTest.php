<?php

namespace Tests\Api\V1;

use App\Helpers\OauthHelper;
use App\Http\Controllers\Api\LoginController;
use App\Models\OauthClient;
use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class LoginControllerTest extends TestCase
{
    use DatabaseMigrations;
    use DatabaseTransactions;

    /**
     * @test
     * @see LoginController::__invoke()
     */
    public function api_can_get_access_and_refresh_token(): void
    {
        OauthHelper::createPasswordGrantClient('client', 'users');
        $password = 'secret';
        $user = factory(User::class)->create(['password' => Hash::make($password)]);
        $client = OauthClient::where('password_client', 1)->first();
        $this->post('/oauth/token', [
            'grant_type'    => 'password',
            'client_id'     => $client->id,
            'client_secret' => $client->secret,
            'username'      => $user->email,
            'password'      => $password,
            'scope'         => '',
        ])->assertJsonStructure(['access_token', 'refresh_token']);
    }
}
