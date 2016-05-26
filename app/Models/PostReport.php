<?php

namespace Forum\Models;

use Forum\Models\Post;
use Illuminate\Database\Eloquent\Model;

class PostReport extends Model
{
    protected $table = 'post_reports';

    protected $fillable = [
        'reason',
        'post_id',
        'user_id',
    ];

    public function posts()
    {
        return $this->belongsTo(Post::class);
    }
}
