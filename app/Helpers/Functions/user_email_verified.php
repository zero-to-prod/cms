<?php

use App\Models\User;

if (! function_exists('user_email_verified')) {
    function user_email_verified(string $user_email)
    {
        $user = User::where('email', $user_email)->first();

        return $user->email_verified_at === null;
    }
}
