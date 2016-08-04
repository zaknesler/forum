<?php

namespace Forum\Listeners\Forum\Topic;

class UpdateLastPostAt
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
     * @param Event $event
     *
     * @return void
     */
    public function handle($event)
    {
        $topic = $event->topic;

        $topic->last_post_at = $event->post->created_at;
        $topic->save();
    }
}
