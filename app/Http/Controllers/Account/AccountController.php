<?php

namespace Forum\Http\Controllers\Account;

use Forum\Models\User;
use Forum\Http\Requests;
use Illuminate\Http\Request;
use Forum\Http\Controllers\Controller;
use Forum\Http\Requests\Account\UpdateProfileFormRequest;

class AccountController extends Controller
{
    /**
     * Get the view to update user's profile settings.
     * @return \Illuminate\Http\Response
     */
    public function getProfile()
    {
        return view('account.settings.profile');
    }
    
    /**
     * Post request to update the user's profile settings.
     * @param  UpdateProfileFormRequest  Form request for validation.
     * @param  User                      User model injection.
     * @return \Illuminate\Http\RedirectResponse
     */
    public function postProfile(UpdateProfileFormRequest $request, User $user)
    {
        $current = $user->find(auth()->user()->id);

        if (!$request->input('first_name') && $request->input('last_name')) {
            notify()->flash('Error', 'error', [
                'text' => 'A first name is required if the last name is set.',
                'timer' => 5000,
            ]);

            return redirect()->back();
        }

        $current->update([
            'first_name' => $request->input('first_name'),
            'last_name' => $request->input('last_name'),
            'location' => $request->input('location'),
            'website' => $request->input('website'),
            'about' => $request->input('about'),
        ]);

        if ($request->input('image')) {
            $current->update([
                'image_uuid' => \Uploadcare::getFile($request->input('image'))->getUuid(),
            ]);
        }

        notify()->flash('Success', 'success', [
            'text' => 'Your profile settings have been updated.',
            'timer' => 2000,
        ]);

        return redirect()->route('account.settings.profile');
    }
}
