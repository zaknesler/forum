<?php

namespace Forum\Http\Controllers\Report;

use Forum\Models\Topic;
use Forum\Http\Requests;
use Illuminate\Http\Request;
use Forum\Http\Controllers\Controller;

class TopicReportController extends Controller
{
    /**
     * Report topic.
     * @param  integer  $id     Topic identifier.
     * @param  Topic    $topic  Topic model injection.
     * @return \Illuminate\Http\RedirectResponse
     */
    public function report($id, Topic $topic)
    {
        $toReport = $topic->findOrFail($id);
        $reports = $toReport->reports();
        $userId = auth()->user()->id;

        if (!$reports->where('user_id', $userId)->count()) {
            $toReport->reports()->create([
                'user_id' => $userId,
            ]);
        }        

        notify()->flash('Success', 'success', [
            'text' => 'Thank you for reporting.',
            'timer' => 2000,
        ]);

        return redirect()->back();
    }

    /**
     * Remove all reports.
     * @param  integer  $id     Topic identifier.
     * @param  Topic    $topic  Topic model injection.
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id, Topic $topic)
    {
        $toDestroy = $topic->findOrFail($id);

        $toDestroy->reports()->delete();

        notify()->flash('Success', 'success', [
            'text' => 'Reports have been cleared.',
            'timer' => 2000,
        ]);

        return redirect()->back();
    }
}
