<?php

namespace Forum\Models;

use Zizaco\Entrust\Traits\EntrustUserTrait;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use EntrustUserTrait;
    
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
}
