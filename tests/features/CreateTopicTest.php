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

    /** @test */
    function a_topic_can_be_replied_to()
    {
        $user = factory(User::class)->create();
        $topic = factory(Topic::class)->create();

        $this->actingAs($user)
            ->visit('topics/' . $topic->slug . '/' . $topic->id)
            ->type('This is just a test reply to the topic.', 'body')
            ->press('Post');

        $this->assertResponseStatus(200);
        $this->assertEquals(1, Post::count());
        $this->assertEquals($topic->id, Post::first()->id);
    }
}
