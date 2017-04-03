<?php

namespace App\Http\Controllers\Settings;

use Illuminate\Http\Request;
use App\Jobs\User\UploadAvatar;
use App\Http\Controllers\Controller;
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
        $this->dispatch(new UploadAvatar($request->user(), $request->file('avatar')->getRealPath()));

        flash('Avatar has been updated. Changes will take effect briefly.');

        return redirect()->route('settings.index');
    }
}
