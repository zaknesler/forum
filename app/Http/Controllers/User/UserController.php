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
     * Display user's profile page.
     * @param  string $username Username
     * @param  User   $user     User model injection.
     * @return \Illuminate\Http\Response
     */
    public function profile($username, User $user)
    {
        $find = $user->where('username', $username)->first();

        if (!$find) {
            return abort(404);
        }

        return view('user.profile', [
            'user' => $find,    
        ]);
    }

    /**
     * Get all users.
     * @param  User  $user  User model injection.
     * @return \Illuminate\Http\Response
     */
    public function all(User $user)
    {
        $users = $user->paginate(25);

        return view('user.list', [
            'users' => $users,    
        ]);
    }

    /**
     * Update user's role.
     * @param  integer                    $id      User identifier.
     * @param  UpdateUserRoleFormRequest  $request Form request for validation.
     * @param  User                       $user    User model injection.
     * @param  Role                       $role    Role model injection.
     * @return \Illuminate\Http\RedirectResponse
     */
    public function updateRole($id, UpdateUserRoleFormRequest $request, User $user, Role $role)
    {
        if (auth()->user()->hasRole(['owner'])) {
            $current = $user->findOrFail($id);
            $role = $role->findOrFail($request->role);

            $current->detachRoles($current->roles);
            $current->attachRole($role);

            notify()->flash('Success', 'success', [
                'text' => 'User role has been changed',
                'timer' => 2000,
            ]);
        }

        return redirect()->back();
    }
}
