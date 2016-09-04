<?php

namespace Forum\Http\Controllers\Settings;

use Forum\Http\Requests;
use Illuminate\Http\Request;
use Forum\Http\Controllers\Controller;
use Forum\Http\Requests\Settings\UpdateProfileFormRequest;

class ProfileSettingsController extends Controller
{
    /**
     * Update the user's profile settings.
     *
     * @param  Forum\Http\Requests\Settings\UpdateProfileFormRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(UpdateProfileFormRequest $request)
    {
        $user = $request->user();

        $user->update($request->only([
            'name',
            'email',
        ]));

        flash('Your profile settings have been updated.');

        return redirect()->route('settings.index');
    }
}
