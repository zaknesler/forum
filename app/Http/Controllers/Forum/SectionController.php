<?php

namespace Forum\Http\Controllers\Forum;

use Forum\Http\Requests;
use Forum\Models\Section;
use Illuminate\Http\Request;
use Forum\Http\Controllers\Controller;
use Forum\Http\Requests\Forum\CreatePostFormRequest;

class SectionController extends Controller
{
    public function index(Section $section)
    {
        $sections = $section->get();

        return view('forum.section.all')->withSections($sections);
    }

    public function show($id, Section $section)
    {
        $show = $section->find($id);

        if (!$show) {
            notify()->flash('That section was not found.', 'error', [
                'timer' => 2000,
            ]);

            return redirect()->route('forum.section.all');
        }

        return view('forum.section.show', [
            'section' => $show,
            'topics' => $show->topics()->get(),
        ]);
    }
}
