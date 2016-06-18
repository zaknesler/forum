<?php

namespace Forum\Models;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $fillable = [
        'body',
        'reports_count',
        'user_id',
        'topic_id',
    ];

    protected $dates = [
        'deleted_at',
    ];

    public function scopeLatestFirst($query)
    {
        return $query->orderBy('created_at', 'desc');
    }

    public function scopeLatestLast($query)
    {
        return $query->orderBy('created_at', 'asc');
    }

    public function scopeHasReports($query)
    {
        return $query->where('reports_count', '>', 0);
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

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function topic()
    {
        return $this->belongsTo(Topic::class);
    }
}
