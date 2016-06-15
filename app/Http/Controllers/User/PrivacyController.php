<?php

namespace Forum\Http\Controllers\User;

use Forum\Models\User;
use Forum\Http\Requests;
use Illuminate\Http\Request;
use Forum\Events\User\UserWasEdited;
use Forum\Http\Controllers\Controller;

class PrivacyController extends Controller
{
    /**
     * Update the user's privacy settings.
     *
     * @param  Forum\Models\User          $user
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update($id, Request $request, User $user)
    {
        $user = $user->findOrFail($id);

        $user->view_profile = $request->has('view_profile');
        $user->view_profile_email = $request->has('view_profile_email');

        $user->update();

        event(new UserWasEdited($user));

        notify()->flash('Success', 'success', [
            'text' => 'Your privacy settings have been updated.',
            'timer' => 2000,
        ]);

        return redirect()->back();
    }
}
