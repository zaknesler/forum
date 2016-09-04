<?php

namespace Forum\Http\Controllers\Settings;

use Exception;
use Forum\Http\Requests;
use Illuminate\Http\Request;
use Forum\Http\Controllers\Controller;
use Forum\Http\Requests\Settings\UpdateAvatarFormRequest;

class AvatarSettingsController extends Controller
{
    /**
     * Update the user's avatar. Delete old avatar if it exists.
     *
     * @param  Forum\Http\Requests\Settings\UpdateAvatarFormRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(UpdateAvatarFormRequest $request)
    {
        $user = $request->user();

        $oldAvatar = $user->avatar;

        $uploadcare = app()->uploadcare;

        /**
         * Use uploadcare to create an instance of an uploadcare image.
         */
        $avatar = $uploadcare->getFile($request->input('avatar'));

        /**
         * Mark the avatar as stored in Uploadcare.
         */
        $avatar->store();

        $user->avatar = $avatar->getUuid();
        $user->update();

        flash('Your avatar has been updated.');

        /**
         * If no previous avatar was set, redirect back.
         */
        if (!$oldAvatar) {
            return redirect()->route('settings.index');
        }

        /**
         * If the user had a previous avatar, try to delete it from Uploadcare.
         *
         * This saves space on your Uploadcare account.
         */
        try {
            $uploadcare->getFile($oldAvatar)->delete();
        } catch (Exception $exception) {
            //
        }

        return redirect()->route('settings.index');
    }

    /**
     * Delete the user's avatar from Uploadcare and revert back to using Gravatar.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Request $request)
    {
        $user = $request->user();

        $avatar = $user->avatar;

        if (!$avatar) {
            return redirect()->route('settings.index');
        }

        $uploadcare = app()->uploadcare;

        try {
            $uploadcare->getFile($avatar)->delete();
        } catch (Exception $exception) {
            //
        }

        $user->avatar = null;
        $user->update();

        flash('Your avatar has been deleted. We will revert back to using Gravatar.');

        return redirect()->route('settings.index');
    }
}
