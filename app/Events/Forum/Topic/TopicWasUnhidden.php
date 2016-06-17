<?php

namespace Forum\Events\Forum\Topic;

use Forum\Models\User;
use Forum\Events\Event;
use Forum\Models\Topic;
use Forum\Models\Section;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class TopicWasUnhidden extends Event
{
    use SerializesModels;

    public $topic;
    public $section;
    public $user;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(Topic $topic, Section $section, User $user)
    {
        $this->topic = $topic;
        $this->section = $section;
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
