<?php

namespace App\Http\Controllers\Settings;

use Illuminate\Http\Request;
use App\Jobs\User\DeleteAvatar;
use App\Jobs\User\UploadAvatar;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\Settings\UpdateAvatar;

class AvatarController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Update the user's avatar settings.
     *
     * @param  App\Http\Requests\Settings\UpdateAvatar  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(UpdateAvatar $request)
    {
        Storage::disk('avatars-temp')->putFileAs('', $request->file('avatar'), $file = uniqid(true));

        $this->dispatch(new UploadAvatar($request->user(), $file));

        flash('Avatar has been updated. Changes will take effect briefly.');

        return redirect()->route('settings.index');
    }
}
