<?php

namespace Forum\Http\Controllers\Report;

use Forum\Models\Post;
use Forum\Http\Requests;
use Illuminate\Http\Request;
use Forum\Http\Controllers\Controller;

class PostReportController extends Controller
{
    /**
     * Report post.
     * @param  integer  $id    Post identifier.
     * @param  Post     $post  Post model injection.
     * @return \Illuminate\Http\RedirectResponse
     */
    public function report($id, Post $post)
    {
        $toReport = $post->findOrFail($id);
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
}
