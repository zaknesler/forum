<?php

namespace Forum\Http\Controllers\Report;

use Forum\Topic;
use Forum\Http\Requests;
use Illuminate\Http\Request;
use Forum\Http\Controllers\Controller;

class TopicReportController extends Controller
{
    /**
     * Toggle the report status of the topic.
     *
     * @param  Forum\Topic  $topic
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Topic $topic, Request $request)
    {
        $topic->toggleReport($request->user());

        flash('Topic has been ' . $topic->reportStatus() . '.');

        return redirect()->back();
    }
}
