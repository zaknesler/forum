<?php

namespace App\Http\Controllers;

use App\Models\Topic;
use Illuminate\Http\Request;
use App\Http\Requests\Post\StorePost;

class PostController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  App\Http\Requests\Post\StorePost  $request
     * @param  App\Models\Topic  $topic
     * @return \Illuminate\Http\Response
     */
    public function store(StorePost $request, Topic $topic)
    {
        $topic->posts()->create([
            'user_id' => $request->user()->id,
            'body' => $request->body,
        ]);

        flash('Post has been created.');

        return redirect()->route('topics.show', $topic->slug);
    }
}
