<?php

namespace Forum\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    protected $fillable = [
        'username',
        'name',
        'location',
        'website',
        'image_uuid',
        'about',
        'admin',
        'active',
        'email',
        'password',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $dates = [
        'deleted_at',
    ];

    public function getNameOrUsername()
    {
        if ($this->name) {
            return $this->name;
        } else {
            return $this->username;
        }
    }
}
