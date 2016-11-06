<?php

namespace Forum\Http\Controllers;

use Forum\Models\User;
use Forum\Http\Requests;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Show the user's profile.
     *
     * @param  string  $username
     * @param  Forum\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show($username, User $user)
    {
        $user = $user->where('username', $username)->firstOrFail();

        return view('users.show')
            ->with('user', $user);
    }
}
