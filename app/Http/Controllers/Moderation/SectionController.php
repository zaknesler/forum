<?php

namespace Forum\Http\Controllers\Moderation;

use Forum\Http\Requests;
use Forum\Models\Section;
use Illuminate\Http\Request;
use Forum\Http\Controllers\Controller;

class SectionController extends Controller
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
     * Mark section as deleted (using soft deletes).
     * @param  integer  $id       Section identifier.
     * @param  Section  $section  Section model injection.
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id, Section $section)
    {
        $destroy = $section->findOrFail($id);

        $destroy->delete();
        $destroy->topics()->delete();

        return redirect()->back();
    }
}
