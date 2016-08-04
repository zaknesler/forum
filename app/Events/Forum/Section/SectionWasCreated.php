<?php

namespace Forum\Events\Forum\Section;

use Forum\Events\Event;
use Forum\Models\Section;
use Forum\Models\User;
use Illuminate\Queue\SerializesModels;

class SectionWasCreated extends Event
{
    use SerializesModels;

    public $section;
    public $user;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(Section $section, User $user)
    {
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
