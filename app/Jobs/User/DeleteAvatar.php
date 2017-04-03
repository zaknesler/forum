<?php

namespace App\Jobs\User;

use Storage;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class DeleteAvatar implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * User to verify avatar.
     *
     * @var App\Models\User
     */
    protected $user;

    /**
     * The avatar to be deleted.
     *
     * @var string
     */
    protected $avatar;

    /**
     * Create a new job instance.
     *
     * @param  App\Models\User  $user
     * @param  string  $avatar
     */
    public function __construct(User $user, $avatar)
    {
        $this->user = $user;

        $this->avatar = $avatar;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        if ($this->user->avatar == $this->avatar) {
            Storage::disk('avatars')->delete($this->user->avatar);

            $this->user->update(['avatar' => null]);
        }
    }
}
