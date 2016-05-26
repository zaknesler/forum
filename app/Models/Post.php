<?php

namespace Forum\Models;

use Forum\Models\User;
use Forum\Models\Topic;
use Forum\Models\PostReport;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $fillable = [
        'body',
        'user_id',
        'topic_id',
    ];

    public function scopeReported($query)
    {
        return $this->reports()->count();
    }

    public function scopeLatestFirst($query)
    {
        return $query->orderBy('created_at', 'desc');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function topic()
    {
        return $this->belongsTo(Topic::class);
    }

    public function reports()
    {
        return $this->hasMany(PostReport::class);
    }
}
