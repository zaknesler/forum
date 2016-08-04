<?php

namespace Forum\Listeners\Forum\Topic;

use Forum\Events\Forum\Topic\TopicWasReported;

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
     * @param TopicWasReported $event
     *
     * @return void
     */
    public function handle(TopicWasReported $event)
    {
        $event->topic->increment('reports_count');
    }
}
