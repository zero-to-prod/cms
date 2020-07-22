<?php

namespace App\Helpers\Classes;

class ApiHelper
{
    /**
     * Determines if a user cannot login via the Api.
     *
     * @return bool
     * @see ApiHelperTest::cannotLogin()
     */
    public static function cannotLogin(): bool
    {
        return ! self::canLogin();
    }

    /**
     * Determines if a user can login via the Api.
     *
     * @return bool
     * @see ApiHelperTest::canLogin()
     */
    public static function canLogin(): bool
    {
        return config('api.API_CAN_LOGIN') === '1';
    }

    /**
     * Determines if a user can register via the Api.
     *
     * @return bool
     * @see ApiHelperTest::canRegister()
     */
    public static function canRegister(): bool
    {
        return config('api.API_CAN_REGISTER') === '1';
    }

    /**
     * Determines if a user cannot register via the Api.
     *
     * @return bool
     * @see ApiHelperTest::cannotRegister()
     */
    public static function cannotRegister(): bool
    {
        return ! self::canRegister();
    }

    /**
     * Determines if the authentication log is enabled.
     *
     * @return bool
     * @see ApiHelperTest::authLogEnabled()
     */
    public static function authLogEnabled(): bool
    {
        return config('api.API_AUTH_LOG_ENABLED') === '1';
    }

    /**
     * Determines if the authentication log is disabled.
     *
     * @return bool
     * @see ApiHelperTest::authLogDisabled()
     */
    public static function authLogDisabled(): bool
    {
        return ! self::authLogEnabled();
    }
}
