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
        Role::whereNotIn('name', collect(config('forum.roles')))->delete();

        collect(config('forum.roles'))
            ->each(function ($key, $value) {
                Role::updateOrCreate(['name' => $key]);
            });
    }
}
