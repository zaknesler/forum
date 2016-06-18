<?php

use Forum\Models\Topic;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Topic::class, 9464)->create();

        // $this->call(RolesTableSeeder::class);
        // $this->call(UsersTableSeeder::class);
    }
}
