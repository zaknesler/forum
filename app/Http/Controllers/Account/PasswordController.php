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
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = auth()->user();

        return view('account.settings.profile')
            ->with('user', $user);
    }

    /**
     * Update the user's password.
     *
     * @param  UpdatePasswordFormRequest  $request
     * @param  Forum\Models\User          $user
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(UpdatePasswordFormRequest $request, User $user)
    {
        $user = auth()->user();

        if (Hash::check($request->input('old_password'), $user->password)) {
            $user->password = bcrypt($request->input('password'));
            $user->update();

            notify()->flash('Success', 'success', [
                'text' => 'Your password has been changed.',
                'timer' => 2000,
            ]);
        }

        notify()->flash('Error', 'error', [
            'text' => 'Your old password is incorrect.',
            'timer' => 2000,
        ]);

        return redirect()->route('account.settings.password');
    }
}
