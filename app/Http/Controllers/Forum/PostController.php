<?php

namespace Forum\Http\Controllers\Forum;

use Forum\Models\Post;
use Forum\Models\Topic;
use Forum\Http\Requests;
use Illuminate\Http\Request;
use Forum\Http\Controllers\Controller;
use Forum\Events\Forum\Post\PostWasCreated;
use Forum\Events\Forum\Post\PostWasDeleted;
use Forum\Events\Forum\Post\PostWasReported;
use Forum\Events\Forum\Post\PostReportsWereCleared;
use Forum\Http\Requests\Forum\Post\CreatePostFormRequest;

class PostController extends Controller
{
    /**
     * Report post.
     *
     * @param  integer            $id
     * @param  Forum\Models\Post  $post
     * @return \Illuminate\Http\RedirectResponse
     */
    public function report($id, Post $post)
    {
        $post = $post->findOrFail($id);

        event(new PostWasReported($post));

        notify()->flash('Success', 'success', [
            'text' => 'Thank you for reporting.',
            'timer' => 2000,
        ]);

        return redirect()->back();
    }

    /**
     * Clear reports on post.
     *
     * @param  integer            $id
     * @param  Forum\Models\Post  $post
     * @return \Illuminate\Http\RedirectResponse
     */
    public function clearReports($id, Post $post)
    {
        $post = $post->findOrFail($id);

        event(new PostReportsWereCleared($post));

        notify()->flash('Success', 'success', [
            'text' => 'Reports have been cleared.',
            'timer' => 2000,
        ]);

        return redirect()->back();
    }

    /**
     * Store the user's reply to a thread.
     *
     * @param  CreatePostFormRequest  $request
     * @param  Forum\Models\Topic     $topic
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(CreatePostFormRequest $request, Topic $topic)
    {
        $post = $topic->posts()->create([
            'body' => $request->input('body'),
            'user_id' => $request->user()->id,
        ]);

        event(new PostWasCreated($topic));

        notify()->flash('Success', 'success', [
            'text' => 'Your post has been added.',
            'timer' => 2000,
        ]);

        return redirect()->route('forum.topic.show', [
            'slug' => $topic->slug,
            'id' => $topic->id,
        ]);
    }

    /**
     * Mark post as deleted.
     * @param  integer                  $id
     * @param  Illuminate\Http\Request  $request
     * @param  Forum\Models\Post        $post
     * @param  Forum\Models\Topic       $topic
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id, Request $request, Post $post, Topic $topic)
    {
        $post = $post->findOrFail($id);

        notify()->flash('Success', 'success', [
            'text' => 'Post has been deleted.',
            'timer' => 2000,
        ]);

        event(new PostWasDeleted($topic));

        $topic = $post->topic()->first();

        $post->delete();

        return redirect()->route('forum.topic.show', [
            'slug' => $topic->slug,
            'id' => $topic->id,
        ]);
    }
}
