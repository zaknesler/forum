<?php

namespace Forum\Http\Controllers;

use Forum\Post;
use Forum\Topic;
use Forum\Http\Requests;
use Illuminate\Http\Request;
use Forum\Http\Requests\Post\CreatePostFormRequest;

class PostController extends Controller
{
    /**
     * Store the post in the database.
     *
     * @param  CreatePostFormRequest  $request
     * @param  Topic  $topic
     * @param  Post  $post
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(CreatePostFormRequest $request, Topic $topic, Post $post)
    {
        $this->authorize('create', $post);

        $topic->posts()->create([
            'body' => $request->input('body'),
            'user_id' => $request->user()->id,
        ]);

        flash('Post has been created.');

        return redirect()->route('topics.show', [$topic->slug, $topic->id]);
    }
}
