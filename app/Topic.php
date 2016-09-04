<?php

namespace Forum;

use Forum\User;
use Illuminate\Database\Eloquent\Model;

class Topic extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title',
        'body',
    ];

    /**
     * Get the user that owns the topic.
     */
    public function user()
    {
        $this->belongsTo(User::class);
    }
}
