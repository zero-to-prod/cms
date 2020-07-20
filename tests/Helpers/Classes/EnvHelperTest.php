<?php

namespace Tests\Helpers\Classes;

use App\Helpers\Classes\EnvHelper;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

/** @see slug() */
class EnvHelperTest extends TestCase
{

    use DatabaseMigrations;
    use DatabaseTransactions;

    /** @test */
    public function can_write_to_env(): void
    {
        $key   = 'TEST_VALUE';
        $value = 'value';
        EnvHelper::write($key, $value);
        self::assertEquals($value, env($key));
    }
}
