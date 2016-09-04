<?php

namespace Forum;

use App\Topic;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'username',
        'email',
        'group',
        'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * If the user has a name set, return it; otherwise, return the username.
     *
     * @return mixed
     */
    public function getNameOrUsername()
    {
        if (!$this->name) {
            return $this->username;
        }

        return $this->name;
    }

    /**
     * Check if the user's group is that of the argument.
     *
     * @param  mixed  $group
     * @return boolean
     */
    public function isGroup($group)
    {
        if (is_array($group)) {
            return in_array($this->group, $group);
        }

        return $this->group === $group;
    }

    /**
     * Get the topics that the user owns.
     */
    public function topics()
    {
        $this->hasMany(Topic::class);
    }
}
