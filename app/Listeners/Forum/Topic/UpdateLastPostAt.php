<?php

namespace Forum\Listeners\Forum\Topic;

use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class UpdateLastPostAt
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
     * @param  Event  $event
     * @return void
     */
    public function handle($event)
    {
        $event->topic->last_post_at = $event->post->created_at;
        $event->topic->save();
    }
}
