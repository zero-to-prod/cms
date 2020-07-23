<?php

namespace Tests\Helpers\Classes;

use App\Helpers\ApiHelper;
use Illuminate\Support\Facades\Config;
use Tests\TestCase;

class ApiHelperTest extends TestCase
{
    protected const API_CAN_LOGIN = 'api.API_CAN_LOGIN';
    protected const API_CAN_REGISTER = 'api.API_CAN_REGISTER';
    protected const API_AUTH_LOG_ENABLED = 'api.API_AUTH_LOG_ENABLED';

    /**
     * @test
     * @see ApiHelper::canLogin()
     */
    public function canLogin(): void
    {
        $key = self::API_CAN_LOGIN;
        Config::set($key, '1');
        self::assertTrue(ApiHelper::canLogin());
    }

    /**
     * @test
     * @see ApiHelper::cannotLogin()
     */
    public function cannotLogin(): void
    {
        $key = self::API_CAN_LOGIN;
        Config::set($key, '0');
        self::assertTrue(ApiHelper::cannotLogin());
    }

    /**
     * @test
     * @see ApiHelper::canRegister()
     */
    public function canRegister(): void
    {
        $key = self::API_CAN_REGISTER;
        Config::set($key, '1');
        self::assertTrue(ApiHelper::canRegister());
    }

    /**
     * @test
     * @see ApiHelper::cannotRegister()
     */
    public function cannotRegister(): void
    {
        $key = self::API_CAN_REGISTER;
        Config::set($key, '0');
        self::assertTrue(ApiHelper::cannotRegister());
    }

    /**
     * @test
     * @see ApiHelper::authLogEnabled()
     */
    public function authLogEnabled(): void
    {
        $key = self::API_AUTH_LOG_ENABLED;
        Config::set($key, '1');
        self::assertTrue(ApiHelper::authLogEnabled());
    }

    /**
     * @test
     * @see ApiHelper::authLogDisabled()
     */
    public function authLogDisabled(): void
    {
        $key = self::API_AUTH_LOG_ENABLED;
        Config::set($key, '0');
        self::assertTrue(ApiHelper::authLogDisabled());
    }
}
