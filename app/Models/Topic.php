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
        'title',
        'slug',
        'body',
        'raw_body',
        'section_id',
    ];

    public function scopeLatestFirst($query)
    {
        return $query->orderBy('created_at', 'desc');
    }

    public function reportCountText()
    {
        $count = $this->reportCount();

        if ($count == 1) {
            return $count . ' report';
        }

        return $count . ' reports';
    }

    public function replyCountText()
    {
        $count = $this->replyCount();

        if ($count == 1) {
            return $count . ' reply';
        }

        return $count . ' replies';
    }

    public function replyCount()
    {
        return $this->posts()->count();
    }

    public function reportCount()
    {
        return $this->reports()->count();
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

    public function reports()
    {
        return $this->hasMany(TopicReport::class);
    }
}
