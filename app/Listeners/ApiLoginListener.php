<?php

namespace App\Listeners;

use App\Events\ApiLoginEvent;
use App\Helpers\AuthLogHelper;

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
     * @param  ApiLoginEvent  $event
     *
     * @return void
     */
    public function handle(ApiLoginEvent $event): void
    {
        AuthLogHelper::login($event->user->id, $event->request);
    }
}
