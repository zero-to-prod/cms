<?php

namespace App\Helpers;

use App\Models\AuthLog;
use Illuminate\Http\Request;

class AuthLogHelper
{
    /**
     * @param $user_id
     * @param  Request  $request
     *
     * @return AuthLog
     * @todo Make test.
     */
    public static function login($user_id, Request $request): AuthLog
    {
        return self::create($user_id, $request, true);
    }

    /**
     * @param $user_id
     * @param  Request  $request
     * @param  bool  $login
     *
     * @return AuthLog
     * @todo Make test.
     */
    public static function create($user_id, Request $request, $login = true): AuthLog
    {
        $auth_log = new AuthLog();
        $auth_log->user_id = $user_id;
        $auth_log->login = $login;
        $auth_log->url = $request->url();
        $auth_log->full_url = $request->fullUrl();
        $auth_log->path = $request->path();
        $auth_log->secure = $request->secure();
        $auth_log->user_agent = $request->userAgent();
        $auth_log->fingerprint = $request->fingerprint();
        $auth_log->ip_address = $request->ip();
        $auth_log->save();

        return $auth_log;
    }

    /**
     * @param $user_id
     * @param  Request  $request
     *
     * @return AuthLog
     * @todo Make test.
     */
    public static function logout($user_id, Request $request): AuthLog
    {
        return self::create($user_id, $request, false);
    }
}
