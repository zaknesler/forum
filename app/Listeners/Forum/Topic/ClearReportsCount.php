<?php

namespace Forum\Listeners\Forum\Topic;

use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Forum\Events\Forum\Topic\TopicReportsWereCleared;

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
     * @param  TopicReportsWereCleared  $event
     * @return void
     */
    public function handle(TopicReportsWereCleared $event)
    {
        $topic = $event->topic;

        $topic->reports_count = 0;
        $topic->update();
    }
}
