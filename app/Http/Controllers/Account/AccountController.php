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
     * Get request to update the user's profile settings.
     * 
     * @return view
     */
    public function getProfile()
    {
        return view('account.settings.profile');
    }
    
    /**
     * Post request to update the user's profile settings.
     * 
     * @param  UpdateProfileFormRequest
     * @param  User
     * @return redirect
     */
    public function postProfile(UpdateProfileFormRequest $request, User $user)
    {
        $current = $user->find(auth()->user()->id);

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

        notify()->flash('Your profile settings have been updated.', 'success', [
            'timer' => 2000,
        ]);

        return redirect()->route('account.settings.profile');
    }
}
