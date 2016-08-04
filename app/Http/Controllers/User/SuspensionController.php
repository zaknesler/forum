<?php

namespace Forum\Http\Controllers\User;

use Forum\Events\User\UserWasEdited;
use Forum\Http\Controllers\Controller;
use Forum\Models\User;
use Illuminate\Http\Request;

class SuspensionController extends Controller
{
    /**
     * Suspend the user.
     *
     * @param int               $id
     * @param Request           $request
     * @param Forum\Models\User $user
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function suspend($id, Request $request, User $user)
    {
        $user = $user->findOrFail($id);

        if (auth()->user()->id !== $user->id) {
            if (!(auth()->user()->hasRole(['admin']) && $user->hasRole(['owner']))) {
                $user->suspended = true;

                $user->update();

                event(new UserWasEdited($user));

                notify()->flash('Success', 'success', [
                    'text'  => 'User has been suspended.',
                    'timer' => 2000,
                ]);
            }
        }

        return redirect()->back();
    }

    /**
     * Unsuspend the user.
     *
     * @param int               $id
     * @param Request           $request
     * @param Forum\Models\User $user
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function unsuspend($id, Request $request, User $user)
    {
        $user = $user->findOrFail($id);

        if (auth()->user()->id !== $user->id) {
            if (!(auth()->user()->hasRole(['admin']) && $user->hasRole(['owner']))) {
                $user->suspended = false;

                $user->update();

                event(new UserWasEdited($user));

                notify()->flash('Success', 'success', [
                    'text'  => 'User has been unsuspended.',
                    'timer' => 2000,
                ]);
            }
        }

        return redirect()->back();
    }
}
