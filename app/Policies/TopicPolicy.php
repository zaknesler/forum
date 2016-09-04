<?php

namespace Forum\Policies;

use Forum\User;
use Forum\Topic;
use Illuminate\Auth\Access\HandlesAuthorization;

class TopicPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view the topic.
     *
     * @param  Forum\User  $user
     * @param  Forum\Topic  $topic
     * @return mixed
     */
    public function view(User $user, Topic $topic)
    {
        //
    }

    /**
     * Determine whether the user can create topics.
     *
     * @param  Forum\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        //
    }

    /**
     * Determine whether the user can update the topic.
     *
     * @param  Forum\User  $user
     * @param  Forum\Topic  $topic
     * @return mixed
     */
    public function update(User $user, Topic $topic)
    {
        //
    }

    /**
     * Determine whether the user can delete the topic.
     *
     * @param  Forum\User  $user
     * @param  Forum\Topic  $topic
     * @return mixed
     */
    public function delete(User $user, Topic $topic)
    {
        //
    }
}
