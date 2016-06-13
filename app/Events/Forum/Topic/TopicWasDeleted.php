<?php

namespace Forum\Events\Forum\Topic;

use Forum\Events\Event;
use Forum\Models\Topic;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class TopicWasDeleted extends Event
{
    use SerializesModels;

    public $topic;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(Topic $topic)
    {
        $this->topic = $topic;
    }

    /**
     * Get the channels the event should be broadcast on.
     *
     * @return array
     */
    public function broadcastOn()
    {
        return [];
    }
}
