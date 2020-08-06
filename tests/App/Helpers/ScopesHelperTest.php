<?php

namespace Tests\App\Helpers;

use App\Helpers\OauthHelper;
use App\Helpers\ScopesHelper;
use App\Models\OauthClient;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Support\Facades\Config;
use Tests\TestCase;

class ScopesHelperTest extends TestCase
{
    use DatabaseTransactions;
    use DatabaseMigrations;

    /**
     * @test
     * @see ScopesHelper::tokensCan()
     */
    public function tokensCan(): void
    {
        self::assertIsArray(ScopesHelper::tokensCan());
    }

    /**
     * @test
     * @see ScopesHelper::asString()
     */
    public function asString()
    {
        $scopes = [
            'admin'     => 'Admin',
            'dashboard' => 'Dashboard'
        ];
        Config::set('scopes', $scopes);
        $actual = ScopesHelper::asString();
        self::assertIsString($actual);
        self::assertEquals('admin dashboard', $actual);
    }
}
