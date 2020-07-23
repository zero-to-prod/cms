<?php

namespace App\Listeners;

use App\Events\ApiLogoutEvent;
use App\Helpers\AuthLogHelper;

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
     * @param  ApiLogoutEvent  $event
     *
     * @return void
     */
    public function handle(ApiLogoutEvent $event): void
    {
        AuthLogHelper::logout($event->user->id, $event->request);
    }
}
