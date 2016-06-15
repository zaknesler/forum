<?php

namespace Forum\Events\Forum\Section;

use Forum\Events\Event;
use Forum\Models\Section;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class SectionWasCreated extends Event
{
    use SerializesModels;

    public $section;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(Section $section)
    {
        $this->section = $section;
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
