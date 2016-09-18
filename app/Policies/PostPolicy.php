<?php

namespace Forum\Policies;

use Forum\Post;
use Forum\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class PostPolicy
{
    use HandlesAuthorization;

    protected $staffIgnoredAbilities = [
        'report',
    ];

    /**
     * Method to be called before all others.
     *
     * @param  Forum\User  $user
     * @param  void  $ability
     * @return boolean
     */
    public function before(User $user, $ability)
    {
        if ($user->isGroup(['moderator', 'administrator']) && in_array($ability, $this->staffIgnoredAbilities)) {
            return false;
        }

        if ($user->isGroup('administrator')) {
            return true;
        }
    }

    /**
     * Determine whether the user can view the post.
     *
     * @param  Forum\User  $user
     * @param  Forum\Post  $post
     * @return mixed
     */
    public function view(User $user, Post $post)
    {
        return true;
    }

    /**
     * Determine whether the user can create posts.
     *
     * @param  Forum\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return true;
    }

    /**
     * Determine whether the user can update the post.
     *
     * @param  Forum\User  $user
     * @param  Forum\Post  $post
     * @return mixed
     */
    public function update(User $user, Post $post)
    {
        return $user->id == $post->user_id;
    }

    /**
     * Determine whether the user can delete the post.
     *
     * @param  Forum\User  $user
     * @param  Forum\Post  $post
     * @return mixed
     */
    public function delete(User $user, Post $post)
    {
        return $user->id == $post->user_id;
    }

    /**
     * Determine whether the user can report the post.
     *
     * @param  Forum\User  $user
     * @param  Forum\Post  $post
     * @return mixed
     */
    public function report(User $user, Post $post)
    {
        return $user->id !== $post->user_id;
    }
}
