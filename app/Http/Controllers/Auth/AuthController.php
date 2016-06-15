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

    /**
     * Path to redirect to after successful login.
     *
     * @var string
     */
    protected $redirectTo = '/';

    /**
     * Create a new auth controller instance.
     */
    public function __construct()
    {
        $this->middleware($this->guestMiddleware(), ['except' => 'logout']);
    }

    /**
     * Validation rules for registering a new user.
     *
     * @param  array  $data
     * @return Validator
     */
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

    /**
     * Create new user with data.
     *
     * @param  array  $data
     * @return Forum\Models\User
     */
    protected function create(array $data)
    {
        $options = json_encode([
            'privacy' => [
                'profile' => [
                    'view' => true,
                    'view_email' => false,
                ],
            ],
        ]);

        $user = User::create([
            'username' => $data['username'],
            'email' => $data['email'],
            'first_name' => $data['first_name'],
            'last_name' => $data['last_name'],
            'options' => $options,
            'password' => bcrypt($data['password']),
        ]);

        /**
         * If user is first in database, give them the 'owner' role.
         * Otherwise, give them the 'user' role.
         */
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
