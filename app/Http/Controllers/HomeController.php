<?php

namespace Forum\Http\Controllers;

use Forum\Http\Requests;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        return view('index');
    }
}
