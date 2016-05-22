<?php

namespace Forum\Http\Controllers\Forum;

use Forum\Http\Requests;
use Forum\Models\Section;
use Illuminate\Http\Request;
use Forum\Http\Controllers\Controller;
use Forum\Http\Requests\Forum\CreateSectionFormRequest;

class SectionController extends Controller
{
    /**
     * Get the view to show all sections.
     * @param  Section  $section  Section model injection.
     * @return \Illuminate\Http\Response
     */
    public function all(Section $section)
    {
        $sections = $section->paginate(10);

        return view('moderation.section.all')->withSections($sections);
    }

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

        return view('forum.section.show', [
            'section' => $show,
            'topics' => $show->topics()->paginate(10),
        ]);
    }
}
