<?php

namespace Forum\Events\Forum\Post;

use Forum\Events\Event;
use Forum\Models\Post;
use Forum\Models\User;
use Illuminate\Queue\SerializesModels;

class PostWasReported extends Event
{
    use SerializesModels;

    public $post;
    public $user;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(Post $post, User $user)
    {
        $this->post = $post;
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
