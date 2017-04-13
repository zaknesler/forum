<?php

namespace App\Jobs\User;

use Image;
use Storage;
use App\Models\User;
use Illuminate\Bus\Queueable;
use App\Jobs\User\DeleteAvatar;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class UploadAvatar implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * The user to save the avatar to.
     *
     * @var App\Models\user
     */
    protected $user;

    /**
     * The temporary file to upload.
     *
     * @var string
     */
    protected $file;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(User $user, $file)
    {
        $this->user = $user;
        $this->file = $file;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        dispatch(new DeleteAvatar($this->user->avatar));

        $fileName = uniqid(true) . '.jpg';

        Storage::disk('avatars')->put($fileName, Image::make(Storage::disk('avatars-temp')->get($this->file))
            ->fit(250, 250, function ($constraint) {
                $constraint->aspectRatio();
            })->encode('jpg'));

        Storage::disk('avatars-temp')->delete($this->file);

        $this->user->update(['avatar' => $fileName]);
    }
}
