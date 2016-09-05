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
        'avatar',
        'group',
        'password',
        'last_login_at',
    ];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = [
        'last_login_at',
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
     * Get the path to the user's avatar. Use Gravatar as a fall-back.
     *
     * @param  integer  $size
     *
     * @return string
     */
    public function getAvatar(int $size = 100)
    {
        if (!$this->avatar) {
            return 'https://www.gravatar.com/avatar/' . md5(strtolower($this->email)) . '?s=' . $size . '&d=mm';
        }

        return 'https://ucarecdn.com/' . $this->avatar . '/-/scale_crop/1024x1024/center/-/quality/lighter/-/progressive/yes/-/resize/' . $size . '/';
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
