<?php

namespace Forum\Events\Forum\Topic;

use Forum\Models\User;
use Forum\Events\Event;
use Forum\Models\Topic;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class TopicWasEdited extends Event
{
    use SerializesModels;

    public $topic;
    public $user;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(Topic $topic, User $user)
    {
        $this->topic = $topic;
        $this->user = $user;
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
