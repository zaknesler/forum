<?php

namespace Forum\Http\Controllers\Settings;

use Hash;
use Forum\Http\Requests;
use Illuminate\Http\Request;
use Forum\Http\Controllers\Controller;
use Forum\Http\Requests\Settings\UpdatePasswordFormRequest;

class PasswordSettingsController extends Controller
{
    /**
     * Update the user's password.
     *
     * @param  Forum\Http\Requests\Settings\UpdatePasswordFormRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(UpdatePasswordFormRequest $request)
    {
        $user = $request->user();

        if (!Hash::check($request->input('old_password'), $user->password)) {
            flash()->error('Your old password is incorrect.');

            return redirect()->route('settings.index');
        }

        $user->update([
            'password' => bcrypt($request->input('password')),
        ]);

        flash('Your password has been updated.');

        return redirect()->route('settings.index');
    }
}
