<?php

namespace Forum\Listeners\Forum\Post;

use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Forum\Events\Forum\Post\PostReportsWereCleared;

class ClearReportsCount
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
     * @param  PostReportsWereCleared  $event
     * @return void
     */
    public function handle(PostReportsWereCleared $event)
    {
        $post = $event->post;

        $post->reports = 0;
        $post->update();
    }
}
