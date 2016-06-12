<?php

namespace Forum\Http\Controllers\Auth;

use Validator;
use Forum\Models\Role;
use Forum\Models\User;
use Forum\Events\User\UserWasCreated;
use Forum\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;

class AuthController extends Controller
{
    use AuthenticatesAndRegistersUsers, ThrottlesLogins;

    protected $redirectTo = '/';

    public function __construct()
    {
        $this->middleware($this->guestMiddleware(), ['except' => 'logout']);
    }

    protected function validator(array $data)
    {
        return Validator::make($data, [
            'username' => 'required|max:32|unique:users',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|min:6',
            'first_name' => 'max:255',
            'last_name' => 'max:255',
        ]);
    }

    protected function create(array $data)
    {
        $user = User::create([
            'username' => $data['username'],
            'email' => $data['email'],
            'first_name' => $data['first_name'],
            'last_name' => $data['last_name'],
            'password' => bcrypt($data['password']),
        ]);

        if (User::count() == 1) {
            $role = Role::where('name', 'owner')->first();
        } else {
            $role = Role::where('name', 'user')->first();
        }

        $user->roles()->attach($role->id);

        event(new UserWasCreated($user));

        return $user;
    }
}
