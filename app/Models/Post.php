<?php

namespace Forum\Models;

use Forum\Models\User;
use Forum\Models\Topic;
use Forum\Models\Report;
use Forum\Traits\Reportable;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use Reportable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    protected $fillable = [
        'body',
        'user_id',
    ];

    /**
     * The post belongs to a user.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * The post belongs to a topic.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function topic()
    {
        return $this->belongsTo(Topic::class);
    }
}
