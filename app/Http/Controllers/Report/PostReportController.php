<?php

namespace Forum\Http\Controllers\Report;

use Forum\Post;
use Forum\Http\Requests;
use Illuminate\Http\Request;
use Forum\Http\Controllers\Controller;

class PostReportController extends Controller
{
    /**
     * Toggle the report status of the post.
     *
     * @param  Forum\Post  $post
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Post $post, Request $request)
    {
        $this->authorize('report', $post);

        $post->toggleReport($request->user());

        flash('Post has been ' . $post->reportStatus() . '.');

        return redirect()->back();
    }

    /**
     * Delete all reports for specified post.
     *
     * @param  Forum\Post  $post
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Post $post, Request $request)
    {
        if (!$request->user()->isGroup(['moderator', 'administrator'])) {
            abort(404);
        }

        $post->reports()->delete();

        flash('Reports for this post have been cleared.');

        return redirect()->back();
    }
}
