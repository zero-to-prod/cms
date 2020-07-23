<?php

namespace App\Helpers;

use App\Models\User;
use Tests\Helpers\Classes\UserHelperTest;

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
     * @param  string  $user_email
     * @todo Make Test
     * @return bool
     */
    public static function user_email_verified(string $user_email): bool
    {
        $user = User::where('email', $user_email)->first();

        return $user->email_verified_at === null;
    }
}
