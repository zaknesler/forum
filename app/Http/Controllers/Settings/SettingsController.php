<?php

namespace App\Http\Controllers\Settings;

use App\Http\Controllers\Controller;

class SettingsController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display the user settings page.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = request()->user()->load('privacy');

        return view('settings.index', compact('user'));
    }
}
