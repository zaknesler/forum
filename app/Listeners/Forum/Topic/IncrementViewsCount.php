<?php

namespace Forum\Listeners\Forum\Topic;

use Forum\Events\Forum\Topic\TopicWasViewed;

class IncrementViewsCount
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
     * @param TopicWasViewed $event
     *
     * @return void
     */
    public function handle(TopicWasViewed $event)
    {
        $event->topic->increment('views_count');
    }
}
