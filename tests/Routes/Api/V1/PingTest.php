<?php

namespace Tests\Routes\Api\V1;

use App\Http\Controllers\Api\PingController;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class PingTest extends TestCase
{
    use DatabaseMigrations;
    use DatabaseTransactions;

    /**
     * @test
     * @see PingController::__invoke()
     */
    public function ping(): void
    {
        $status   = 200;
        $response = $this->get('/api/v1/ping');
        $response->assertStatus($status);
        $response->assertJson([
            'title'  => config('api.ping_response'),
            'status' => $status
        ]);
    }
}
