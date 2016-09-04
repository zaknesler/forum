<?php

namespace Forum\Console\Commands;

use Forum\User;
use Illuminate\Console\Command;

class SetUserGroup extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'user:group
                            {user : The ID of the user}
                            {group : The name of the group desired}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Change a user\'s group.';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $user = User::find($this->argument('user'));

        if (!$user) {
            die($this->error('That is not a valid user.'));
        }

        $group = $this->argument('group');

        $groups = [
            'user',
            'moderator',
            'administrator',
        ];

        if (!in_array($group, $groups)) {
            die($this->error('That is not a valid group.'));
        }

        $user->group = $group;
        $user->update();

        $this->info('The user\'s group has been updated to ' . $group . '.');
    }
}
