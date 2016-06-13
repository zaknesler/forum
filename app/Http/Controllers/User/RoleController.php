<?php

namespace Forum\Http\Controllers\User;

use Forum\Models\Role;
use Forum\Models\User;
use Forum\Http\Requests;
use Illuminate\Http\Request;
use Forum\Http\Controllers\Controller;
use Forum\Http\Requests\User\UpdateUserRoleFormRequest;

class RoleController extends Controller
{
    /**
     * Update user's role.
     *
     * @param  integer                    $id
     * @param  UpdateUserRoleFormRequest  $request
     * @param  Forum\Models\User          $user
     * @param  Forum\Models\Role          $role
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update($id, UpdateUserRoleFormRequest $request, User $user, Role $role)
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
