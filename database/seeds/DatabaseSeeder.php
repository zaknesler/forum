<?php

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
        factory(Forum\Models\Topic::class, 250)->create()->each( function($u) {
            $u->posts()->save(factory(Forum\Models\Post::class)->make());
        });
    }
}
