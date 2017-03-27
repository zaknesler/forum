<?php

namespace App\Http\Controllers\Settings;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Settings\UpdateProfile;

class ProfileSettingsController extends Controller
{
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

        flash('Profile has been updated.');

        return redirect()->route('settings.index');
    }
}
