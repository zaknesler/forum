<?php

namespace Forum\Models;

use Illuminate\Database\Eloquent\Model;

class TopicReport extends Model
{
    protected $fillable = [
        'reason',
        'topic_id',
        'user_id',
    ];

    public function topics()
    {
        return $this->belongsTo(Topic::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
