<?php

namespace Forum\Models;

use Illuminate\Database\Eloquent\Model;
use AlgoliaSearch\Laravel\AlgoliaEloquentTrait;

class Post extends Model
{
    use AlgoliaEloquentTrait;

    public static $autoIndex = true;
    public static $autoDelete = true;
    
    protected $fillable = [
        'body',
        'user_id',
        'topic_id',
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

    public function reportCount()
    {
        return $this->reports()->count();
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
