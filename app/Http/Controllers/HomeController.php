<?php

namespace Forum\Http\Controllers;

use Forum\Http\Requests;
use Forum\Models\Section;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Get the view for the home page.
     *
     * @param  Forum\Models\Section $section
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
