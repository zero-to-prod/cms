<?php

namespace App\Helpers\Classes;

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
}