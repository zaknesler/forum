<?php

namespace Forum\Models;

use Forum\Models\Topic;
use Illuminate\Database\Eloquent\Model;

class TopicReport extends Model
{
    protected $table = 'topic_reports';

    protected $fillable = [
        'reason',
        'topic_id',
        'user_id',
    ];

    public function topics()
    {
        return $this->belongsTo(Topic::class);
    }
}
