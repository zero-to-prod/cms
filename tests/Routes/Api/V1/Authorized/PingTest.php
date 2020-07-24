<?php

namespace Tests\Routes\Api\V1\Authorized;

use App\Http\Controllers\Api\PingAuthorizedController;
use App\Http\Controllers\Api\PingController;
use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Laravel\Passport\Passport;
use Tests\TestCase;

class PingTest extends TestCase
{

    use DatabaseMigrations;
    use DatabaseTransactions;

    /**
     * @test
     * @see PingAuthorizedController::__invoke()
     */
    public function notAuthorized(): void
    {
        $status   = 302;
        $response = $this->get('/api/v1/ping/authorized');
        $response->assertStatus($status);
    }

    /**
     * @test
     * @see PingAuthorizedController::__invoke()
     */
    public function authorized(): void
    {
        Passport::actingAs(factory(User::class)->create());
        $status   = 200;
        $response = $this->get('/api/v1/ping/authorized');
        $response->assertStatus($status);
        $response->assertJson([
            'title'  => config('api.ping_authorized_response'),
            'status' => $status
        ]);
    }
}
