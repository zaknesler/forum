<?php

namespace Forum\Listeners\Forum\Section;

use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Forum\Events\Forum\Topic\TopicWasCreated;

class IncrementTopicsCount
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
     * @param  TopicWasCreated  $event
     * @return void
     */
    public function handle(TopicWasCreated $event)
    {
        $event->topic->section()->increment('topics_count');
    }
}
