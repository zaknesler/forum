<?php

namespace Forum\Listeners\User;

use Forum\Events\User\UserWasAuthenticated;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class UpdateUserLastActiveAt
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
    public function handle(UserWasAuthenticated $event)
    {
        $event->user->update([
            'last_login_at' => \Carbon\Carbon::now(),
        ]);
    }
}
