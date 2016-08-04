<?php

namespace Forum\Events\Forum\Post;

use Forum\Events\Event;
use Forum\Models\User;
use Illuminate\Queue\SerializesModels;

class PostWasDeleted extends Event
{
    use SerializesModels;

    public $user;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(User $user)
    {
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
