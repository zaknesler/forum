<?php

namespace Forum\Http\Controllers\Forum;

use Forum\Http\Requests;
use Forum\Models\Section;
use Illuminate\Http\Request;
use Forum\Http\Controllers\Controller;
use Forum\Http\Requests\Forum\CreatePostFormRequest;

class SectionController extends Controller
{
    /**
     * Get the view to show all sections.
     * @param  Section  Section model injection.
     * @return \Illuminate\Http\Response
     */
    public function index(Section $section)
    {
        $sections = $section->paginate(25);

        return view('forum.section.all')->withSections($sections);
    }

    /**
     * Get the view to show all topics under a specific section.
     * @param  integer  Section identifier.
     * @param  Section  Section model injection.
     * @return \Illuminate\Http\Response
     */
    public function show($id, Section $section)
    {
        $show = $section->findOrFail($id);

        return view('forum.section.show', [
            'section' => $show,
            'topics' => $show->topics()->get(),
        ]);
    }
}
