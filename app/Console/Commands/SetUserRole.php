<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;

class SetUserRole extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'user:role
                            {user : The ID of the user}
                            {role : The name of the role desired}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Update a user\'s role';

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
        User::findOrFail($this->argument('user'))
            ->syncRoles($this->argument('role'));

        $this->info('User\'s role has been updated.');
    }
}
