<?php

namespace Forum\Http\Controllers;

use Forum\Http\Requests;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Get the view for the home page.
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('index');
    }
}
