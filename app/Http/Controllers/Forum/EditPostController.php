<?php

namespace Forum\Http\Controllers\Forum;

use Forum\Http\Controllers\Controller;
use Forum\Http\Requests\Forum\Post\EditPostFormRequest;
use Forum\Models\Post;

class EditPostController extends Controller
{
    /**
     * Get the view to edit an existing post.
     *
     * @param int               $id
     * @param Forum\Models\Post $post
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id, Post $post)
    {
        $post = $post->findOrFail($id);
        $user = auth()->user();

        if (($user->id == $post->user->id) || ($user->hasRole(['moderator', 'admin', 'owner']))) {
            return view('forum.post.edit')
                ->with('post', $post);
        } else {
            return redirect()->route('home');
        }
    }

    /**
     * Post section edit.
     *
     * @param int               $id
     * @param Forum\Models\Post $post
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update($id, EditPostFormRequest $request, Post $post)
    {
        $post = $post->findOrFail($id);
        $topic = $post->topic;

        $post->update([
            'body' => $request->input('body'),
        ]);

        notify()->flash('Success', 'success', [
            'text'  => 'Post has been updated.',
            'timer' => 2000,
        ]);

        return redirect()->route('forum.topic.show', [
            'slug' => $topic->slug,
            'id'   => $topic->id,
        ]);
    }
}
