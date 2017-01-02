<?php

use Forum\Models\Post;
use Forum\Models\User;
use Forum\Models\Topic;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class CreatePostTest extends TestCase
{
    use DatabaseMigrations;

    /** @test */
    function a_post_can_be_created()
    {
        $user = factory(User::class)->create();
        $topic = factory(Topic::class)->create();

        $this->actingAs($user)
            ->visit('topics/' . $topic->slug . '/' . $topic->id)
            ->type('This is just a test reply to the topic.', 'body')
            ->press('Post');

        $post = Post::first();

        $this->assertResponseStatus(200);
        $this->assertEquals(1, Post::count());
        $this->assertEquals('This is just a test reply to the topic.', $post->body);
        $this->assertEquals($topic->id, $post->topic_id);
    }
}
