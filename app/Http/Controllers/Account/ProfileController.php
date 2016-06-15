<?php

namespace Forum\Http\Controllers\Account;

use Forum\Models\User;
use Forum\Http\Requests;
use Illuminate\Http\Request;
use Forum\Events\User\UserWasEdited;
use Forum\Http\Controllers\Controller;
use Forum\Http\Requests\Account\UpdateProfileFormRequest;

class ProfileController extends Controller
{
    /**
     * Get the view to update user's profile settings.
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
     * Post request to update the user's profile settings.
     *
     * @param  UpdateProfileFormRequest  $request
     * @param  Forum\Models\User         $user
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(UpdateProfileFormRequest $request, User $user)
    {
        $user = auth()->user();

        if (!$request->input('first_name') && $request->input('last_name')) {
            notify()->flash('Error', 'error', [
                'text' => 'A first name is required if the last name is set.',
                'timer' => 5000,
            ]);

            return redirect()->back();
        }

        $user->first_name = $request->input('first_name');
        $user->last_name = $request->input('last_name');
        $user->location = $request->input('location');
        $user->website = $request->input('website');
        $user->about = $request->input('about');

        if ($request->input('image')) {
            $user->image_uuid = \Uploadcare::getFile($request->input('image'))->getUuid();
        }

        $user->update();

        event(new UserWasEdited($user));

        notify()->flash('Success', 'success', [
            'text' => 'Your profile settings have been updated.',
            'timer' => 2000,
        ]);

        return redirect()->route('account.settings.profile');
    }
}
