<?php

namespace App\Http\Controllers\Settings;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Settings\UpdatePrivacy;

class PrivacyController extends Controller
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
     * @param  App\Http\Requests\Settings\UpdatePrivacy  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(UpdatePrivacy $request)
    {
        $request->user()->privacy()->updateOrCreate([], [
            'show_email' => request()->filled('show_email'),
        ]);

        flash(trans('flash.settings.privacy.updated'));

        return redirect()->route('settings.index');
    }
}
