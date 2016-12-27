<?php

namespace Forum\Models;

use Forum\Models\Post;
use Forum\Models\User;
use Forum\Models\Report;
use Forum\Traits\Reportable;
use Illuminate\Database\Eloquent\Model;

class Topic extends Model
{
    use Reportable;

    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = [];

    /**
     * A topic belongs to a user.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * A topic has many posts.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function posts()
    {
        return $this->hasMany(Post::class);
    }
}
