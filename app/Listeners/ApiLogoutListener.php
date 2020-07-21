<?php

namespace App\Listeners;

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
        $auth_log = new AuthLog();
        $auth_log->user_id = auth()->user()->id;
        $auth_log->logout = true;
        $auth_log->save();
    }
}
