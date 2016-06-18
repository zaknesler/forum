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
    ];

    protected $dates = [
        'last_topic_at',
        'deleted_at',
    ];

    public function getLatestTopic($id)
    {
        return $this->findOrFail($id)->topics()->latestFirst()->first();
    }

    public function topicCountText()
    {
        $count = $this->topicCount();

        if ($count == 1) {
            return number_format($count) . ' topic';
        }

        return number_format($count) . ' topics';
    }

    public function topicCount()
    {
        return $this->topics()->isVisible()->count();
    }

    public function topics()
    {
        return $this->hasMany(Topic::class);
    }
}
