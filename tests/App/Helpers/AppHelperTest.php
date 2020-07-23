<?php

namespace Tests\App\Helpers;

use App\Helpers\AppHelper;
use Illuminate\Support\Facades\Config;
use Tests\TestCase;

class AppHelperTest extends TestCase
{
    protected const REQUEST_LOG_ENABLED = 'app.REQUEST_LOG_ENABLED';

    /**
     * @test
     * @see AppHelper::requestLogEnabled()
     */
    public function requestLogEnabled(): void
    {
        $key = self::REQUEST_LOG_ENABLED;
        $value = '1';
        Config::set($key, $value);
        self::assertTrue(AppHelper::requestLogEnabled());
    }

    /**
     * @test
     * @see AppHelper::requestLogEnabled()
     */
    public function requestLogNotEnabled(): void
    {
        $key = self::REQUEST_LOG_ENABLED;
        $value = '0';
        Config::set($key, $value);
        self::assertTrue(AppHelper::requestLogNotEnabled());
    }
}
