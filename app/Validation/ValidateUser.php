<?php

namespace App\Validation;

use Tests\App\Helpers\AdminHelperTest;

class ValidateUser
{

    /**
     * @return array|string[]
     */
    public static function id(): array
    {
        return ['required'];
    }

    /**
     * @return array|string[]
     * @see AdminHelperTest::getAdmin()
     */
    public static function name(): array
    {
        $name_max_length = config('api.name_max_length');
        $name_min_length = config('api.name_min_length');

        return ['required', 'string', "max:$name_max_length", "min:$name_min_length"];
    }

    /**
     * @return array|string[]
     */
    public static function email(): array
    {
        $email_max_length = config('api.email_max_length');

        return ['required', 'string', 'email', "max:$email_max_length", 'unique:users'];
    }

    /**
     * @return array|string[]
     */
    public static function password(): array
    {
        $password_max_length = config('api.password_max_length');
        $password_min_length = config('api.password_min_length');

        return ['required', 'string', "min:$password_min_length", "max:$password_max_length"];
    }

    /**
     * @return array|string[]
     */
    public static function localeForRegistration(): array
    {
        return ['string'];
    }

    /**
     * @return array|string[]
     */
    public static function locale(): array
    {
        return ['required', 'string'];
    }
}
