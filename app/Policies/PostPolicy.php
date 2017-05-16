<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Post;
use Illuminate\Auth\Access\HandlesAuthorization;

class PostPolicy
{
    use HandlesAuthorization;

    /**
     * Override all other authorization methods.
     *
     * @param  App\Models\User  $user
     * @param  string  $ability
     * @return boolean
     */
    public function before($user, $ability)
    {
        if ($user->hasRole(['moderator', 'admin'])) {
            return true;
        }
    }

    /**
     * Determine whether the user can update the post.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Post  $post
     * @return mixed
     */
    public function update(User $user, Post $post)
    {
        return $user->id == $post->user_id;
    }

    /**
     * Determine whether the user can delete the post.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Post  $post
     * @return mixed
     */
    public function delete(User $user, Post $post)
    {
        return $user->id == $post->user_id;
    }
}
