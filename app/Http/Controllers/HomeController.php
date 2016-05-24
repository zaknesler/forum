<?php

namespace Forum\Http\Controllers;

use Forum\Http\Requests;
use Forum\Models\Section;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Get the view for the home page.
     * @return \Illuminate\Http\Response
     */
    public function index(Section $section)
    {
        if (auth()->user()) {
            $sections = $section->paginate(10);

            return view('home')->withSections($sections);
        }

        return view('index');
    }
}
