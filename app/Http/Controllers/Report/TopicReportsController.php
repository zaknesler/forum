<?php

namespace Forum\Http\Controllers\Report;

use Forum\Models\Topic;
use Forum\Http\Requests;
use Illuminate\Http\Request;
use Forum\Http\Controllers\Controller;

class TopicReportsController extends Controller
{
    public function show(Topic $topic, Request $request) {
        if (!$request->user()->isGroup(['moderator', 'administrator'])) {
            abort(404);
        }

        $reports = $topic->reports()->with('user')->get();

        return view('reports.show')
            ->with('reports', $reports);
    }

    /**
     * Toggle the report status of the topic.
     *
     * @param  Forum\Models\Topic  $topic
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Topic $topic, Request $request)
    {
        $this->authorize('report', $topic);

        $topic->toggleReport($request->user());

        flash('Topic has been ' . $topic->reportStatus() . '.');

        return redirect()->back();
    }
}
