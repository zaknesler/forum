<?php

namespace Forum\Http\Controllers\Account;

use Forum\Models\User;
use Forum\Http\Requests;
use Illuminate\Http\Request;
use Forum\Http\Controllers\Controller;
use Forum\Http\Requests\UserProfileFormRequest;

class AccountController extends Controller
{
    public function getProfile()
    {
        return view('account.settings.profile');
    }
    
    public function postProfile(UserProfileFormRequest $request, User $user)
    {
        
        $user->find(auth()->user()->id)->update([
            'first_name' => $request->input('first_name'),
            'last_name' => $request->input('last_name'),
            'location' => $request->input('location'),
            'website' => $request->input('website'),
            'about' => $request->input('about'),
        ]);

        notify()->flash('Your profile settings have been updated.', 'success', [
            'timer' => 2000,
        ]);

        return redirect()->route('account.settings.profile');
    }
}
