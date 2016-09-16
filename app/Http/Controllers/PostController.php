<?php

namespace Forum\Http\Controllers;

use Forum\Post;
use Forum\Topic;
use Forum\Http\Requests;
use Illuminate\Http\Request;
use Forum\Http\Requests\Post\CreatePostFormRequest;
use Forum\Http\Requests\Post\UpdatePostFormRequest;

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

    /**
     * Show the form for editing the post.
     *
     * @param  Forum\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        $this->authorize('update', $post);

        return view('posts.edit')
            ->with('post', $post);
    }

    /**
     * Update the post in the database.
     *
     * @param  Forum\Post  $post
     * @param  Forum\Http\Requests\Post\UpdatePostFormRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Post $post, UpdatePostFormRequest $request)
    {
        $this->authorize('update', $post);

        $topic = $post->topic;

        $post->update([
            'body' => $request->input('body'),
        ]);

        flash('Post has been updated.');

        return redirect()->route('topics.show', [$topic->slug, $topic->id]);
    }

    /**
     * Remove the post from the database.
     *
     * @param  Forum\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        $this->authorize('delete', $post);

        $topic = $post->topic;

        $post->delete();

        flash('Post has been deleted.');

        return redirect()->route('topics.show', [$topic->slug, $topic->id]);
    }
}
