<?php

namespace Forum\Listeners\Forum\Topic;

class ReindexWithAlgolia
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
     * @param  $event
     *
     * @return void
     */
    public function handle($event)
    {
        $event->topic->reindex();
    }
}
