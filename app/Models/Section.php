<?php

namespace Forum\Models;

use Forum\Models\Topics;
use Illuminate\Database\Eloquent\Model;

class Section extends Model
{
    protected $fillable = [
        'title',
        'slug',
        'description',
    ];

    public function topicCountText()
    {
        $count = $this->topicCount();

        if ($count == 1) {
            return $count . ' topic';
        }

        return $count . ' topics';
    }

    public function topicCount()
    {
        return $this->topics()->count();
    }

    public function topics()
    {
        return $this->hasMany(Topic::class);
    }
}
