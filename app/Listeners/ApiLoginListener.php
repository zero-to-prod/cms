<?php

namespace App\Listeners;

use App\Events\LogApiLogin;
use App\Models\AuthLog;

class ApiLoginListener
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
     * @param  LogApiLogin  $event
     *
     * @return void
     */
    public function handle(LogApiLogin $event): void
    {
        $auth_log                      = new AuthLog();
        $auth_log->user_id             = $event->user->id;
        $auth_log->login               = true;
        $auth_log->url                 = $event->request->url();
        $auth_log->full_url            = $event->request->fullUrl();
        $auth_log->path                = $event->request->path();
        $auth_log->secure              = $event->request->secure();
        $auth_log->user_agent          = $event->request->userAgent();
        $auth_log->fingerprint         = $event->request->fingerprint();
        $auth_log->ip_address          = $event->request->ip();
        $auth_log->save();
    }
}
