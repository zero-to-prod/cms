<?php

namespace App\Helpers\Classes;

use App\Cache\User\CacheUser;
use App\Models\User;

class UserHelper
{
    /**
     * Returns the user model from an email.
     *
     * @param $email
     *
     * @return mixed
     */
    public static function getByEmail($email)
    {
        return User::where('email', $email)->first();
    }
}
