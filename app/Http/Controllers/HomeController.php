<?php

namespace Forum\Http\Controllers;

use Forum\Models\Section;

class HomeController extends Controller
{
    /**
     * Get the view for the home page.
     *
     * @param Forum\Models\Section $section
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Section $section)
    {
        $sections = $section->paginate(config('forum.pagination'));

        return view('home')
            ->with('sections', $sections)
            ->with('count', $sections->count());
    }
}
