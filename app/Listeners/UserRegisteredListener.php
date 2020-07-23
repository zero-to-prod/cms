<?php

namespace App\Listeners;

use App\Events\UserRegisteredEvent;

class UserRegisteredListener
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
    }

    /**
     * Handle the event.
     *
     * @param  UserRegisteredEvent  $event
     *
     * @return void
     */
    public function handle(UserRegisteredEvent $event): void
    {
    }
}
