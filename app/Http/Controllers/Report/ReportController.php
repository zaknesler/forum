<?php

namespace Forum\Http\Controllers\Report;

use Forum\Http\Controllers\Controller;
use Forum\Models\Post;
use Forum\Models\Topic;

class ReportController extends Controller
{
    /**
     * Lists all reported topics and posts.
     *
     * @param Forum\Models\Post $post
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Post $post, Topic $topic)
    {
        $topics = $topic->hasReports()
                        ->get();

        $posts = $post->hasReports()
                      ->get();

        return view('report.reports')
            ->with('topics', $topics)
            ->with('posts', $posts);
    }
}
