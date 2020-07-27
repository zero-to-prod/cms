<?php

namespace App\Helpers;

use App\Models\User;
use Tests\App\Helpers\AdminHelperTest;

class AdminHelper
{
    /**
     * @return mixed
     * @see AdminHelperTest::getAdmin()
     */
    public static function get()
    {
        return User::where('email', config('admin.email'))->first();
    }

    /**
     * @return mixed
     * @see AdminHelperTest::id()
     */
    public static function id()
    {
        return self::get()->id;
    }
}
