<?php

namespace App\Helpers;

class AppHelper
{
    /**
     * Determines if the request log is enabled.
     *
     * @return bool
     * @see AppHelperTest::requestLogEnabled()
     */
    public static function requestLogEnabled(): bool
    {
        return config('app.REQUEST_LOG_ENABLED') === '1';
    }

    /**
     * Determines if the request log is not enabled.
     *
     * @return bool
     * @see AppHelperTest::requestLogNotEnabled()
     */
    public static function requestLogNotEnabled(): bool
    {
        return ! self::requestLogEnabled();
    }
}
