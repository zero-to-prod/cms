<?php

namespace Tests\Uri;

use App\Http\Controllers\Api\PingController;
use Tests\TestCase;

class PingTest extends TestCase
{

    /**
     * @test
     *
     * @see PingController
     */
    public function ping(): void
    {
        $response = $this->get(route('api.ping'))->assertSuccessful();

        // Asserts response contains something like 'PONG'
        $response->assertSee(config('api.ping_response'));
    }
}
