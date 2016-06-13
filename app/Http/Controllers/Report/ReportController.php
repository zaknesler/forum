<?php

namespace Forum\Http\Controllers\Report;

use Forum\Models\Post;
use Forum\Models\Topic;
use Forum\Http\Requests;
use Illuminate\Http\Request;
use Forum\Http\Controllers\Controller;

class ReportController extends Controller
{
    /**
     * Lists all reported topics and posts.
     *
     * @param  Forum\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function index(Post $post, Topic $topic)
    {
        $topics = $topic->hasReports()->get();
        $posts = $post->hasReports()->get();

        return view('moderation.report.reports', [
            'topics' => $topics,
            'posts' => $posts,
        ]);
    }
}
