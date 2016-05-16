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
        // dd($request);
        
        $user->find(auth()->user()->id)->update([
            'name' => $request->input('name'),
            'location' => $request->input('location'),
            'website' => $request->input('website'),
            'about' => $request->input('about'),
        ]);

        return redirect()->route('account.settings.profile');
    }
}
