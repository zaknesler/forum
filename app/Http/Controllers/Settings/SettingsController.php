<?php

namespace Forum\Http\Controllers\Settings;

use Forum\Http\Requests;
use Illuminate\Http\Request;
use Forum\Http\Controllers\Controller;

class SettingsController extends Controller
{
    /**
     * Display the user settings page.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $user = $request->user();

        return view('settings.index')
            ->with('user', $user);
    }
}
