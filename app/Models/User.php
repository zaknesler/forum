<?php

namespace Forum\Models;

use Zizaco\Entrust\Traits\EntrustUserTrait;
use AlgoliaSearch\Laravel\AlgoliaEloquentTrait;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use EntrustUserTrait, AlgoliaEloquentTrait;

    public static $autoIndex = true;
    public static $autoDelete = true;

    protected $fillable = [
        'username',
        'email',
        'first_name',
        'last_name',
        'location',
        'website',
        'about',
        'image_uuid',
        'password',
        'view_profile',
        'view_profile_email',
        'suspended', // Implement
        'posts_count',
        'topics_count',
        'last_login_at',
        'last_active_at',
        'deleted_at',
    ];

    protected $hidden = [
        'remember_token',
        'password',
    ];

    protected $dates = [
        'last_login_at',
        'last_active_at',
        'deleted_at',
    ];

    public function getNameOrUsername()
    {
        if ($this->first_name && $this->last_name) {
            return $this->first_name . ' ' . $this->last_name;
        } else if ($this->first_name && !$this->last_name) {
            return $this->first_name;
        } else {
            return $this->username;
        }
    }

    public function getFullNameOrUsername()
    {
        if ($this->first_name && $this->last_name) {
            return $this->first_name . ' ' . $this->last_name;
        } else {
            return $this->username;
        }
    }

    public function getFullName()
    {
        if ($this->first_name && $this->last_name) {
            return $this->first_name . ' ' . $this->last_name;
        }
    }

    public function getFirstNameOrUsername()
    {
        return isset($this->first_name) ? $this->first_name : $this->username;
    }

    public function avatarUrl(array $options = [])
    {
        $size = array_get($options, 'size', 45);

        if ($this->image_uuid) {
            return 'https://ucarecdn.com/' . $this->image_uuid . '/-/scale_crop/1024x1024/center/-/quality/lighter/-/progressive/yes/-/resize/' . $size . '/';
        }

        return 'https://www.gravatar.com/avatar/' . md5(strtolower($this->email)) . '?s=' . $size . '&d=mm';
    }

    public function roles()
    {
        return $this->belongsToMany(Role::class);
    }

    public function topics()
    {
        return $this->hasMany(Topic::class);
    }
}
