<?php

use Forum\Models\Post;
use Forum\Models\User;
use Forum\Models\Topic;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class CreateTopicTest extends TestCase
{
    use DatabaseMigrations;

    /** @test */
    function user_can_create_a_topic()
    {
        $user = factory(User::class)->create();
        $this->actingAs($user);

        $this->post('/topics/', [
            'title' => 'An example topic',
            'body' => 'A body for the example topic',
        ]);

        $this->assertResponseStatus(302);
        $this->assertEquals(1, Topic::count());
    }
}
