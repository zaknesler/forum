<?php

namespace Forum\Listeners\Forum\Section;

use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Forum\Events\Forum\Topic\TopicWasDeleted;

class DecrementTopicsCount
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
     * @param  TopicWasDeleted  $event
     * @return void
     */
    public function handle(TopicWasDeleted $event)
    {
        $event->topic->section()->decrement('topics_count');
    }
}
