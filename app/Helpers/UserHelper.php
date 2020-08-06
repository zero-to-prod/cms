<?php

namespace App\Helpers;

use App\Models\AuthLog;
use App\Models\User;
use Tests\App\Helpers\UserHelperTest;

class UserHelper
{
    /**
     * @param $email
     *
     * @return mixed
     * @see UserHelperTest::fromEmail()
     */
    public static function fromEmail($email)
    {
        return User::where('email', $email)->first();
    }

    /**
     * @param $email
     *
     * @return mixed
     * @see UserHelperTest::idFromEmail()
     */
    public static function idFromEmail($email)
    {
        return User::where('email', $email)->first(['id'])->id;
    }

    /**
     * @param  string  $email
     *
     * @return bool
     * @see UserHelperTest::emailIsVerified()
     */
    public static function emailIsVerified(string $email): bool
    {
        $user = User::where('email', $email)->first();

        return $user->email_verified_at !== null;
    }

    /**
     * @param  string  $email
     *
     * @return bool
     * @see UserHelperTest::emailIsNotVerified()
     */
    public static function emailIsNotVerified(string $email): bool
    {
        return ! self::emailIsVerified($email);
    }

    /**
     * @param $user_id
     * @param  int  $skip
     *
     * @return mixed
     * @see UserHelperTest::lastLogin()
     */
    public static function lastLogin($user_id, $skip = 0)
    {
        return AuthLog::where(['user_id' => $user_id, 'login' => '1'])->latest()->skip($skip)->first();
    }

    /**
     * @param $email
     *
     * @return mixed
     * @see UserHelperTest::scopes()
     */
    public static function scopes(string $email)
    {
        return User::where('id', self::idFromEmail($email))->first(['id', 'scopes'])->scopes;
    }

    /**
     * @param $email
     *
     * @return mixed
     * @see UserHelperTest::scopesAsArray()
     */
    public static function scopesAsArray(string $email)
    {
        return explode(' ', self::scopes($email));
    }

    /**
     * @param $email
     *
     * @return mixed
     * @see UserHelperTest::canLoginTrue()
     * @see UserHelperTest::canLoginFalse()
     */
    public static function canLogin(string $email)
    {
        return (bool) User::where('email', $email)->first(['id', 'can_login'])->can_login;
    }

    /**
     * @param $email
     *
     * @return mixed
     * @see UserHelperTest::cannotLogin()
     */
    public static function cannotLogin(string $email)
    {
        return ! self::canLogin($email);
    }
}
