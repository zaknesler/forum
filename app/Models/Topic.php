<?php

namespace Forum\Models;

use Illuminate\Database\Eloquent\Model;
use AlgoliaSearch\Laravel\AlgoliaEloquentTrait;

class Topic extends Model
{
    use AlgoliaEloquentTrait;

    public static $autoIndex = true;
    public static $autoDelete = true;
    
    protected $fillable = [
        'name',
        'body',
        'slug',
        'user_id',
        'section_id',
        'spam',
        'locked',
        'reports',
        'hide',
        'posts_count',
        'views_count',
    ];

    protected $dates = [
        'last_post_at',
        'deleted_at',
    ];

    public function scopeLatestFirst($query)
    {
        return $query->orderBy('created_at', 'desc');
    }

    public function scopeLatestLast($query)
    {
        return $query->orderBy('created_at', 'asc');
    }

    public function scopeHasReports($query)
    {
        return $query->where('reports', '>', 0);
    }

    public function reportCountText()
    {
        return $this->reports . ' ' . str_plural('report', $this->reports);
    }

    public function reportCount()
    {
        return $this->reports;
    }

    public function replyCountText()
    {
        return $this->replyCount() . ' ' . str_plural('reply', $this->replyCount());
    }

    public function replyCount()
    {
        return $this->replies_count;
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function section()
    {
        return $this->belongsTo(Section::class);
    }

    public function posts()
    {
        return $this->hasMany(Post::class);
    }
}
