<?php

namespace Forum\Http\Controllers\Report;

use Forum\Models\Topic;
use Forum\Http\Requests;
use Illuminate\Http\Request;
use Forum\Http\Controllers\Controller;

class TopicReportController extends Controller
{
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

    /**
     * Delete all reports for specified topic.
     *
     * @param  Forum\Models\Topic  $topic
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Topic $topic, Request $request)
    {
        if (!$request->user()->isGroup(['moderator', 'administrator'])) {
            abort(404);
        }

        $topic->reports()->delete();

        flash('Reports for this topic have been cleared.');

        return redirect()->back();
    }
}
