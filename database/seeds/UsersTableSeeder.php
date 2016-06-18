<?php

use Forum\Models\User;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     * dfgdfg
     * dfgdfg
     *
     * @return void
     */
    public function run()
    {
        factory(User::class, 50)->create();
    }
}
