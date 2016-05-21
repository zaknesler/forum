<?php

namespace Forum\Http\Controllers\Forum;

use Forum\Models\Topic;
use Forum\Http\Requests;
use Illuminate\Http\Request;
use Forum\Http\Controllers\Controller;
use Forum\Http\Requests\Forum\CreatePostFormRequest;

class PostController extends Controller
{
    /**
     * Store the user's reply to a thread.
     * @param  CreatePostFormRequest  Form request for validation.
     * @param  Topic                  Topic model injection.
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(CreatePostFormRequest $request, Topic $topic)
    {
        $topic->posts()->create([
            'body' => $request->input('body'),
            'user_id' => $request->user()->id,
        ]);

        return redirect()->route('forum.topic.show', ['id' => $topic->id]);
    }
}