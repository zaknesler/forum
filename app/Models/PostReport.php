<?php

namespace Forum\Models;

use Forum\Models\Post;
use Forum\Models\User;
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

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
