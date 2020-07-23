<?php

namespace Tests\Api\V1;

use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Laravel\Passport\Passport;
use Tests\TestCase;

class LogoutControllerTest extends TestCase
{

    use DatabaseMigrations;
    use DatabaseTransactions;

    /**
     * @test
     * @see LogoutController::__invoke()
     */
    public function logout(): void
    {
        $user = factory(User::class)->create();
        Passport::actingAs($user);
        $response = $this->post('/api/v1/logout');
        $response->assertStatus(200);
    }
}
