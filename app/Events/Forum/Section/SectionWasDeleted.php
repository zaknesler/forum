<?php

namespace Forum\Events\Forum\Section;

use Forum\Events\Event;
use Forum\Models\Topic;
use Forum\Models\Section;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class SectionWasDeleted extends Event
{
    use SerializesModels;

    public $section;
    public $topic;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(Section $section, Topic $topic)
    {
        $this->section = $section;
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
