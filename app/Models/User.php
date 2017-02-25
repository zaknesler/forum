<?php

namespace App\Models;

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
     * Return name if it is set; otherwise, return the username.
     *
     * @return string
     */
    public function getNameOrUsername()
    {
        if (!$this->name) {
            return $this->username;
        }

        return $this->name;
    }

    /**
     * Get the avatar of the user.
     *
     * @param  integer  $size
     * @return string
     */
    public function getAvatar(int $size = 100)
    {
        return 'https://www.gravatar.com/avatar/' . md5(strtolower($this->email)) . '?s=' . $size . '&d=mm';
    }
}
