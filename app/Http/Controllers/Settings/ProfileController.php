<?php

namespace App\Http\Controllers\Settings;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Settings\UpdateProfile;

class ProfileController extends Controller
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
     * Update the user's profile settings.
     *
     * @param  App\Http\Requests\Settings\UpdateProfile  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(UpdateProfile $request)
    {
        $request->user()->update($request->only([
            'name',
            'email',
        ]));

        flash(trans('forum.flash.settings.profile.updated'));

        return redirect()->route('settings.index');
    }
}
