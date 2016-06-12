<?php

namespace Forum\Listeners\User;

use Illuminate\Auth\Events\Login;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class UpdateUserLastLoggedInAt
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
     * @param  UserWasActive  $event
     * @return void
     */
    public function handle(Login $event)
    {
        $event->user->last_login_at = \Carbon\Carbon::now();
        $event->user->save();
    }
}
