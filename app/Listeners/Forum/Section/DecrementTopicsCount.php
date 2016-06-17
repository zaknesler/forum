<?php

namespace Forum\Listeners\Forum\Section;

use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

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
     * @return void
     */
    public function handle($event)
    {
        if ($event->topic->section()->first()->topics_count !== 0) {
            $event->topic->section()->decrement('topics_count');
        }
    }
}
