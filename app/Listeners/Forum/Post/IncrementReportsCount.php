<?php

namespace Forum\Listeners\Forum\Post;

use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Forum\Events\Forum\Post\PostWasReported;

class IncrementReportsCount
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
     * @param  PostWasReported  $event
     * @return void
     */
    public function handle(PostWasReported $event)
    {
        $event->post->increment('reports');
    }
}
