<?php

namespace Forum\Models;

use Illuminate\Database\Eloquent\Model;

class Section extends Model
{
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
