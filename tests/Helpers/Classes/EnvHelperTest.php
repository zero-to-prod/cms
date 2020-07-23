<?php

namespace Tests\Helpers\Classes;

use App\Helpers\EnvHelper;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

/** @see EnvHelper */
class EnvHelperTest extends TestCase
{
    use DatabaseMigrations;
    use DatabaseTransactions;

    /**
     * @see EnvHelper::write()
     * @test
     */
    public function can_write_to_env(): void
    {
        $key = 'TEST_VALUE';
        $value = 'value1';
        EnvHelper::write($key, $value);
        self::assertEquals($value, env($key));
    }
}
