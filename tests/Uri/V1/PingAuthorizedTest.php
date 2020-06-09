<?php

namespace Tests\Uri\V1;

use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\PassportTestCase;

class PingAuthorizedTest extends PassportTestCase
{

    use DatabaseTransactions;

    public function testRestrictedRoute(): void
    {
        $this->get(route('api.ping-authorize'))
            ->assertStatus(200);
    }
}