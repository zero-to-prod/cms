<?php

namespace Tests\Uri;

use App\Http\Controllers\Api\PingController;
use Tests\TestCase;

class PingTest extends TestCase
{

    /**
     * test
     *
     * @see PingController
     */
    public function ping(): void
    {
        $this->get(route('api.ping'))->assertSuccessful();
    }
}
