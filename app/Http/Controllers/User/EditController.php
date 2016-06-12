<?php

namespace Forum\Http\Controllers\User;

use Forum\Models\Role;
use Forum\Models\User;
use Forum\Http\Requests;
use Illuminate\Http\Request;
use Forum\Events\User\UserWasEdited;
use Forum\Http\Controllers\Controller;
use Forum\Http\Requests\User\EditUserFormRequest;
use Forum\Http\Requests\User\UpdateUserRoleFormRequest;

class EditController extends Controller
{
    /**
       * Get the view to edit a user.
       * @param  integer  $id    User identifier.
       * @param  user     $user  User model identifier.
       * @return \Illuminate\Http\Response
       */
    public function index($id, User $user, Role $role)
    {
        $edit = $user->with('roles')->findOrFail($id);
        $roles = $role->get();
  
        return view('user.edit', [
            'user' => $edit,
            'roles' => $roles,
        ]);
    }
  
    /**
     * Post user edit.
     * @param  integer  $id    User identifier.
     * @param  User     $user  User model identifier.
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update($id, EditUserFormRequest $request, User $user, Role $role)
    {
        $user = $user->findOrFail($id);
  
        if (!$request->input('first_name') && $request->input('last_name')) {
            notify()->flash('Error', 'error', [
                'text' => 'A first name is required if the last name is set.',
                'timer' => 5000,
            ]);
  
            return redirect()->back();
        }
  
        $user->first_name = $request->input('first_name');
        $user->last_name = $request->input('last_name');
        $user->location = $request->input('location');
        $user->website = $request->input('website');
        $user->about = $request->input('about');

        if ($request->input('image')) {
            $user->image_uuid = \Uploadcare::getFile($request->input('image'))->getUuid();
        }

        $user->update();

        event(new UserWasEdited($user));
  
        notify()->flash('Success', 'success', [
            'text' => 'User has been updated.',
            'timer' => 2000,
        ]);
  
        return redirect()->back();
    }
}
