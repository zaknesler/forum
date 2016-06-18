<?php

namespace Forum\Listeners\Forum\Section;

use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class UpdateLastTopicAt
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
        $section = $event->section;

        $section->last_topic_at = $event->topic->created_at;
        $section->save();
    }
}
