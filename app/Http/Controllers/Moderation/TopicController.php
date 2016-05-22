<?php

namespace Forum\Http\Controllers\Moderation;

use Forum\Models\Topic;
use Forum\Http\Requests;
use Illuminate\Http\Request;
use Forum\Http\Controllers\Controller;

class TopicController extends Controller
{
    /**
     * Get the view to show all topics under a specific section.
     * @param  string   $slug     Section slug.
     * @param  integer  $id       Section identifier.
     * @param  Section  $section  Section model injection.
     * @return \Illuminate\Http\Response
     */
    public function show($slug, Section $section)
    {
        $show = $section->where('slug', $slug)->firstOrFail();

        return view('moderation.section.show', [
            'section' => $show,
            'topics' => $show->topics()->paginate(10),
        ]);
    }

    /**
     * Mark topic as deleted (using soft deletes).
     * @param  integer  $id    Topic identifier.
     * @param  Topic   $topic  Topic model injection.
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id, Topic $topic)
    {
        $destroy = $topic->findOrFail($id);

        $destroy->delete();
        $destroy->posts()->delete();

        return redirect()->back();
    }
}
