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
        return !self::emailIsVerified($email);
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
}
