<?php

namespace App\Listeners;

use App\Cache\User\CacheUserAuth;
use App\Events\LogApiLogout;
use App\Models\AuthLog;

class ApiLogoutListener
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  LogApiLogout  $event
     *
     * @return void
     */
    public function handle(LogApiLogout $event): void
    {
        $user = CacheUserAuth::get();
        $auth_log = new AuthLog();
        $auth_log->user_id = $user->id;
        $auth_log->logout = true;
        $auth_log->save();
    }
}
