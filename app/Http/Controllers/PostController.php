<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Topic;
use Illuminate\Http\Request;
use App\Http\Requests\Post\StorePost;
use App\Http\Requests\Post\UpdatePost;

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
     * Store a newly created post.
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

    /**
     * Show the form for editing the specified post.
     *
     * @param  App\Models\Topic  $topic
     * @param  App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Topic $topic, Post $post)
    {
        $this->authorize('update', $post);

        return view('posts.edit', compact(['topic', 'post']));
    }

    /**
     * Update the specified post.
     *
     * @param  App\Http\Requests\Post\UpdatePost  $request
     * @param  App\Models\Topic  $topic
     * @param  App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePost $request, Topic $topic, Post $post)
    {
        $post->update($request->only(['body']));

        flash('Post has been updated.');

        return redirect()->route('topics.show', $topic->slug);
    }

    /**
     * Remove the specified post.
     *
     * @param  App\Models\Topic  $topic
     * @param  App\Models\Post  $post
     */
    public function destroy(Topic $topic, Post $post)
    {
        $this->authorize('delete', $post);

        $post->delete();

        flash('Post has been removed.');

        return response()->json([
            'redirect_url' => route('topics.show', $topic->slug),
        ]);
    }
}
