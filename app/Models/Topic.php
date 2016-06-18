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
        'is_spam', // Implement: Using third party spam detection.
        'is_locked',
        'is_hidden',
        'reports_count',
        'views_count',
        'last_post_at',
    ];

    protected $dates = [
        'last_post_at',
        'deleted_at',
    ];

    public function scopeLatestFirst($query)
    {
        return $query->orderBy('last_post_at', 'desc')
                     ->orderBy('created_at', 'desc');
    }

    public function scopeLatestLast($query)
    {
        return $query->orderBy('last_post_at', 'asc')
                     ->orderBy('created_at', 'asc');
    }

    public function getLatestPost($id)
    {
        return $this->findOrFail($id)->posts()->latestFirst()->first();
    }

    public function scopeHasReports($query)
    {
        return $query->where('reports_count', '>', 0);
    }

    public function scopeIsVisible($query)
    {
        if (auth()->user() && auth()->user()->hasRole(['moderator', 'admin', 'owner'])) {
            return $query;
        } else {
            return $query->where('is_hidden', false)->where('is_spam', false);
        }
    }

    public function reportCountText()
    {
        $count = $this->reportCount();

        if ($count == 1) {
            return number_format($count) . ' report';
        }

        return number_format($count) . ' reports';
    }

    public function reportCount()
    {
        return $this->reports_count;
    }

    public function replyCountText()
    {
        $count = $this->replyCount();

        if ($count == 1) {
            return number_format($count) . ' reply';
        }

        return number_format($count) . ' replies';
    }

    public function replyCount()
    {
        return $this->posts()->count();
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
