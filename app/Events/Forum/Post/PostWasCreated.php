<?php

namespace Forum\Events\Forum\Post;

use Forum\Models\Post;
use Forum\Models\User;
use Forum\Events\Event;
use Forum\Models\Topic;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class PostWasCreated extends Event
{
    use SerializesModels;

    public $post;
    public $topic;
    public $user;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(Post $post, Topic $topic, User $user)
    {
        $this->post = $post;
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
