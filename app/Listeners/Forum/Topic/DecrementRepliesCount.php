<?php

namespace Forum\Listeners\Forum\Topic;

use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Forum\Events\Forum\Post\PostWasDeleted;

class DecrementRepliesCount
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
     * @param  PostWasDeleted  $event
     * @return void
     */
    public function handle(PostWasDeleted $event)
    {
        $event->post->topic()->decrement('replies_count');
    }
}