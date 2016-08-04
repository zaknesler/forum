<?php

namespace Forum\Http\Controllers\User;

use Forum\Http\Controllers\Controller;
use Forum\Http\Requests\User\UpdateUserRoleFormRequest;
use Forum\Models\Role;
use Forum\Models\User;

class RoleController extends Controller
{
    /**
     * Update user's role.
     *
     * @param int                       $id
     * @param UpdateUserRoleFormRequest $request
     * @param Forum\Models\User         $user
     * @param Forum\Models\Role         $role
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update($id, UpdateUserRoleFormRequest $request, User $user, Role $role)
    {
        $current = $user->findOrFail($id);
        $role = $role->findOrFail($request->role);

        $current->detachRoles($current->roles);
        $current->attachRole($role);

        notify()->flash('Success', 'success', [
            'text'  => 'User role has been changed',
            'timer' => 2000,
        ]);

        return redirect()->back();
    }
}
