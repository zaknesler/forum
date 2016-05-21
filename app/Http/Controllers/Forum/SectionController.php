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
     * 
     * 
     * @param  Section
     * @return \Illuminate\Http\Response
     */
    public function index(Section $section)
    {
        $sections = $section->get();

        return view('forum.section.all')->withSections($sections);
    }

    /**
     * Show the topics that are present in a specific section.
     * 
     * @param  integer
     * @param  Section
     * @return \Illuminate\Http\RedirectResponse
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
