<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class UserRolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        collect(config('forum.roles'))
            ->each(function ($key, $value) {
                Role::create(['name' => $key]);
            });
    }
}
