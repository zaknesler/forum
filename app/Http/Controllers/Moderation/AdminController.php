<?php

namespace Forum\Http\Controllers\Moderation;

use Forum\Http\Requests;
use Forum\Models\Topic;
use Illuminate\Http\Request;
use Forum\Http\Controllers\Controller;

class AdminController extends Controller
{
    
    public function destroyTopic($id, Topic $topic)
    {
        $destroy = $topic->findOrFail($id);

        $destroy->delete();
        $destroy->posts()->delete();

        return redirect()->back();
    }

}
