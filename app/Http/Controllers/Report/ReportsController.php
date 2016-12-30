<?php

namespace Forum\Http\Controllers\Report;

use Forum\Models\Report;
use Illuminate\Http\Request;
use Forum\Http\Controllers\Controller;

class ReportsController extends Controller
{
    /**
     * Delete the report.
     *
     * @param  Forum\Models\Report  $report
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Report $report, Request $request)
    {
        if (!$request->user()->isGroup(['moderator', 'administrator'])) {
            abort(404);
        }

        $report->delete();

        flash('Report has been deleted.');

        return redirect()->back();
    }
}
