<?php

use Forum\Models\Role;
use Illuminate\Database\Seeder;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Role::class)->create([
            'id' => 1,
            'name' => 'owner',
            'display_name' => 'Owner',
            'description' => null,
        ]);

        factory(Role::class)->create([
            'id' => 2,
            'name' => 'admin',
            'display_name' => 'Admin',
            'description' => null,
        ]);

        factory(Role::class)->create([
            'id' => 3,
            'name' => 'moderator',
            'display_name' => 'Moderator',
            'description' => null,
        ]);

        factory(Role::class)->create([
            'id' => 4,
            'name' => 'user',
            'display_name' => 'User',
            'description' => null,
        ]);
    }
}
