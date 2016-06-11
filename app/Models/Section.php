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
