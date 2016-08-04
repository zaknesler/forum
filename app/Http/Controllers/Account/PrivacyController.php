<?php

namespace Forum\Http\Controllers\Account;

use Forum\Events\User\UserWasEdited;
use Forum\Http\Controllers\Controller;
use Forum\Models\User;
use Illuminate\Http\Request;

class PrivacyController extends Controller
{
    /**
     * Get the view to update user's privacy settings.
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
     * Update the user's privacy settings.
     *
     * @param Forum\Models\User $user
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, User $user)
    {
        $user = auth()->user();

        $user->view_profile = $request->has('view_profile');
        $user->view_profile_email = $request->has('view_profile_email');

        $user->update();

        event(new UserWasEdited($user));

        notify()->flash('Success', 'success', [
            'text'  => 'Your privacy settings have been updated.',
            'timer' => 2000,
        ]);

        return redirect()->route('account.settings.privacy');
    }
}
