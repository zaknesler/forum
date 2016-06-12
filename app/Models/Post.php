<?php

namespace Forum\Models;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $fillable = [
        'body',
        'reports',
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
        return $query->where('reports', '>', 0);
    }

    public function reportCountText()
    {
        return $this->reports . ' ' . str_plural('report', $this->reports);
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
