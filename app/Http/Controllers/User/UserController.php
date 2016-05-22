<?php

namespace Forum\Http\Controllers\User;

use Forum\Models\User;
use Forum\Http\Requests;
use Illuminate\Http\Request;
use Forum\Http\Controllers\Controller;

class UserController extends Controller
{
    public function profile($username, User $user)
    {
        $find = $user->where('username', $username)->first();

        return view('user.profile')->withUser($find);
    }
}
