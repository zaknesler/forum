<?php

namespace Forum\Models;

use Illuminate\Database\Eloquent\Model;
use AlgoliaSearch\Laravel\AlgoliaEloquentTrait;

class Section extends Model
{
    use AlgoliaEloquentTrait;

    public static $autoIndex = true;
    public static $autoDelete = true;
    
    protected $fillable = [
        'name',
        'slug',
        'description',
        'topics_count',
    ];

    protected $dates = [
        'last_topic_at',
        'deleted_at',
    ];

    public function topicCountText()
    {
        return $this->topicCount() . ' ' . str_plural('topic', $this->topicCount());
    }

    public function topicCount()
    {
        return $this->topics_count;
    }

    public function topics()
    {
        return $this->hasMany(Topic::class);
    }
}
