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
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = [];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = [
        'reports_count',
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
