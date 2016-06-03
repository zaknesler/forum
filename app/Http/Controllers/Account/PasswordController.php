<?php

namespace Forum\Http\Controllers\Account;

use Forum\Models\User;
use Forum\Http\Requests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Forum\Http\Controllers\Controller;
use Forum\Http\Requests\Account\Password\UpdatePasswordFormRequest;

class PasswordController extends Controller
{
    /**
     * Get the view to update user's password.
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('account.settings.profile');
    }

    /**
     * Update the user's password.
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(UpdatePasswordFormRequest $request, User $user)
    {
        $current = $user->find(auth()->user()->id);

        if (Hash::check($request->input('old_password'), $current->password)) {
            $current->update([
                'password' => bcrypt($request->input('password')),
            ]);

            notify()->flash('Success', 'success', [
                'text' => 'Your password has been changed.',
                'timer' => 2000,
            ]);
        }

        return redirect()->route('account.settings.password');
    }
}
