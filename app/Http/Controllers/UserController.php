<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display the user profile for the specified username.
     *
     * @param  string  $username
     * @return \Illuminate\Http\Response
     */
    public function show($username)
    {
        $user = User::where('username', $username)->firstOrFail();
        $topics = $user->topics()->latest()->paginate(15);

        return view('users.show', compact('user', 'topics'));
    }
}
