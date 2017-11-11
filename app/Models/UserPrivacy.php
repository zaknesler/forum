<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserPrivacy extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'user_privacy';

    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = [];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'show_email' => 'boolean',
    ];
}
