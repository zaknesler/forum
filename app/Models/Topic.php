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
        'spam', // Implement
        'locked', // Implement
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

    public function scopeIsVisible($query)
    {
        if (auth()->user() && auth()->user()->hasRole(['moderator', 'admin', 'owner'])) {
            return $query;
        } else {
            return $query->where('hide', false)->where('spam', false);
        }
    }

    public function reportCountText()
    {
        if ($this->reports == 1) {
            return $this->reports . ' report';
        }

        return $this->reports . ' reports';
    }

    public function reportCount()
    {
        return $this->reports;
    }

    public function replyCountText()
    {
        if ($this->replies_count == 1) {
            return $this->replies_count . ' reply';
        }

        return $this->replies_count . ' replies';
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
