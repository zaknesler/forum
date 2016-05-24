<?php

namespace Forum\Http\Controllers\User;

use Forum\Models\User;
use Forum\Http\Requests;
use Illuminate\Http\Request;
use Forum\Http\Controllers\Controller;

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

    public function all(User $user)
    {
        $users = $user->paginate(25);

        return view('user.list')->withUsers($users);
    }
}
