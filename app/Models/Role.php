<?php

namespace Forum\Models;

use Zizaco\Entrust\EntrustRole;
use AlgoliaSearch\Laravel\AlgoliaEloquentTrait;

class Role extends EntrustRole
{
    use AlgoliaEloquentTrait;

    public static $autoIndex = true;
    public static $autoDelete = true;
    
    protected $fillable = [
        'name',
        'display_name',
        'description',
    ];
}