<?php

namespace Forum\Listeners\User;

class UpdateLastActiveAt
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
     * @return void
     */
    public function handle($event)
    {
        $event->user->last_active_at = \Carbon\Carbon::now();
        $event->user->save();
    }
}
