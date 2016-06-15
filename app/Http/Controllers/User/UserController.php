<?php

namespace Forum\Http\Controllers\User;

use Forum\Models\Role;
use Forum\Models\User;
use Forum\Http\Requests;
use Illuminate\Http\Request;
use Forum\Http\Controllers\Controller;
use Forum\Http\Requests\User\EditUserFormRequest;
use Forum\Http\Requests\User\UpdateUserRoleFormRequest;

class UserController extends Controller
{
    /**
     * Get all users.
     *
     * @param  Illuminate\Http\Request  $request
     * @param  Forum\Models\User        $user
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, User $user)
    {
        if ($request->search) {
            $users = $user->whereIn('id', collect($user->search($request->search)['hits'])->lists('id')->all())->paginate(25);
        } else {
            $users = $user->paginate(25);
        }

        return view('user.list', [
            'users' => $users,
        ]);
    }

    /**
     * Display user's profile page.
     * @param  string             $username
     * @param  Forum\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function profile($username, User $user)
    {
        $user = $user->where('username', $username)->first();

        if (!$user) {
            return abort(404);
        }

        return view('user.profile', [
            'user' => $user,
        ]);
    }

}
