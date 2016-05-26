<?php

namespace Forum\Http\Controllers\Forum;

use Forum\Models\Post;
use Forum\Models\Topic;
use Forum\Http\Requests;
use Illuminate\Http\Request;
use Forum\Http\Controllers\Controller;
use GrahamCampbell\Markdown\Facades\Markdown;
use Forum\Http\Requests\Forum\Post\CreatePostFormRequest;

class PostController extends Controller
{
    /**
     * Store the user's reply to a thread.
     * @param  CreatePostFormRequest  $request  Form request for validation.
     * @param  Topic                  $topic    Topic model injection.
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(CreatePostFormRequest $request, Topic $topic)
    {
        $topic->posts()->create([
            'body' => Markdown::convertToHtml($request->input('body')),
            'user_id' => $request->user()->id,
        ]);

        notify()->flash('Success', 'success', [
            'text' => 'Your post has been added.',
            'timer' => 2000,
        ]);

        return redirect()->route('forum.topic.show', [
            'id' => $topic->id,
            'slug' => $topic->slug,
        ]);
    }

    /**
     * Mark post as deleted.
     * @param  integer  $id    Post identifier.
     * @param  Post     $post  Post model injection.
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id, Post $post)
    {
        $destroy = $post->findOrFail($id);

        $destroy->delete();

        notify()->flash('Success', 'success', [
            'text' => 'Post has been deleted.',
            'timer' => 2000,
        ]);

        return redirect()->back();
    }
}
