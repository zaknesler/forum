<?php

namespace Forum\Policies;

use Forum\User;
use Forum\Topic;
use Illuminate\Auth\Access\HandlesAuthorization;

class TopicPolicy
{
    use HandlesAuthorization;

    /**
     * Method to be called before all others.
     *
     * @param  Forum\User  $user
     * @param  void  $ability
     * @return boolean
     */
    public function before(User $user, $ability)
    {
        if ($user->isGroup('administrator')) {
            return true;
        }
    }

    /**
     * Determine whether the user can view the topic.
     *
     * @param  Forum\User  $user
     * @param  Forum\Topic  $topic
     * @return mixed
     */
    public function view(User $user, Topic $topic)
    {
        return true;
    }

    /**
     * Determine whether the user can create topics.
     *
     * @param  Forum\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return true;
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
        return $user->id === $topic->user_id;
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
        return $user->id === $topic->user_id;
    }
}
