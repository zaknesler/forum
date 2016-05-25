<?php

namespace Forum\Http\Controllers\User;

use Forum\Models\User;
use Forum\Http\Requests;
use Illuminate\Http\Request;
use Forum\Http\Controllers\Controller;
use Forum\Http\Requests\User\EditUserFormRequest;

class UserController extends Controller
{
    /**
     * Display user's profile page.
     * @param  string $username Username
     * @param  User   $user     User model injection.
     * @return \Illuminate\Http\Response
     */
    public function profile($username, User $user)
    {
        $find = $user->where('username', $username)->first();

        return view('user.profile')->withUser($find);
    }

    /**
     * Get all users.
     * @param  User  $user  User model injection.
     * @return \Illuminate\Http\Response
     */
    public function all(User $user)
    {
        $users = $user->paginate(25);

        return view('user.list')->withUsers($users);
    }

    /**
     * Get the view to edit a user.
     * @param  integer  $id    User identifier.
     * @param  user     $user  User model identifier.
     * @return \Illuminate\Http\Response
     */
    public function getEdit($id, User $user)
    {
        $edit = $user->findOrFail($id);

        return view('user.edit')->withUser($edit);
    }

    /**
     * Post user edit.
     * @param  integer  $id    User identifier.
     * @param  User     $user  User model identifier.
     * @return \Illuminate\Http\RedirectResponse
     */
    public function postEdit($id, EditUserFormRequest $request, User $user)
    {
        $current = $user->findOrFail($id);

        if (!$request->input('first_name') && $request->input('last_name')) {
            notify()->flash('Error', 'error', [
                'text' => 'A first name is required if the last name is set.',
                'timer' => 5000,
            ]);

            return redirect()->back();
        }

        $current->update([
            'username' => $request->input('username'),
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
            'text' => 'User has been updated.',
            'timer' => 2000,
        ]);

        return redirect()->route('user.profile', ['username' => $current->username]);
    }
}
