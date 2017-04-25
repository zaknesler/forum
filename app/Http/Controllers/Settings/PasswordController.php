<?php

namespace App\Http\Controllers\Settings;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\Settings\UpdatePassword;

class PasswordController extends Controller
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
     * @param  App\Http\Requests\Settings\UpdatePassword  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(UpdatePassword $request)
    {
        $request->user()->update([
            'password' => Hash::make($request->input('password')),
        ]);

        flash('Password has been updated.');

        return redirect()->route('settings.index');
    }
}
