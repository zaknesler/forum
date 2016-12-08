<?php

namespace Forum\Http\Controllers\Report;

use Forum\Models\Post;
use Forum\Http\Requests;
use Illuminate\Http\Request;
use Forum\Http\Controllers\Controller;

class PostReportController extends Controller
{
    public function show(Post $post, Request $request) {
        if (!$request->user()->isGroup(['moderator', 'administrator'])) {
            abort(404);
        }

        $reports = $post->reports()->with('user')->get();

        return view('reports.show')
            ->with('reports', $reports);
    }

    /**
     * Toggle the report status of the post.
     *
     * @param  Forum\Models\Post  $post
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
     * Delete a report for a specified post.
     *
     * @param  Forum\Models\Post  $post
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Post $post, Request $request)
    {
        if (!$request->user()->isGroup(['moderator', 'administrator'])) {
            abort(404);
        }

        $post->reports()->delete();

        flash('That report has been cleared.');

        return redirect()->back();
    }
}
