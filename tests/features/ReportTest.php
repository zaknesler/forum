<?php

use Forum\Models\Post;
use Forum\Models\User;
use Forum\Models\Topic;
use Forum\Models\Report;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class ReportTopicTest extends TestCase
{
    use DatabaseMigrations;

    /** @test */
    function a_topic_can_reported()
    {
        $topic = factory(Topic::class)->create();
        $user = factory(User::class)->create();

        $this->actingAs($user)
             ->visit('/topics/' . $topic->slug . '/' . $topic->id);

        $this->put('/topics/' . $topic->id . '/report');

        $this->assertResponseStatus(302);
        $this->assertEquals(1, Report::count());
        $this->assertEquals($topic->id, Report::first()->reportable_id);
    }

    /** @test */
    function a_post_can_reported()
    {
        $post = factory(Post::class)->create();
        $user = factory(User::class)->create();

        $this->actingAs($user)
             ->visit('/topics/' . $post->topic->slug . '/' . $post->topic->id);

        $this->put('/topics/posts/' . $post->id . '/report');

        $this->assertResponseStatus(302);
        $this->assertEquals(1, Report::count());
        $this->assertEquals($post->id, Report::first()->reportable_id);
    }

    /** @test */
    function a_reported_topic_can_be_unreported()
    {
        $topic = factory(Topic::class)->create();
        $user = factory(User::class)->create();

        $this->actingAs($user)
             ->visit('/topics/' . $topic->slug . '/' . $topic->id);

        $this->put('/topics/' . $topic->id . '/report');

        $this->assertEquals(1, Report::count());

        $this->put('/topics/' . $topic->id . '/report');

        $this->assertResponseStatus(302);
        $this->assertEquals(0, Report::count());
    }

    /** @test */
    function a_reported_post_can_be_unreported()
    {
        $post = factory(Post::class)->create();
        $user = factory(User::class)->create();

        $this->actingAs($user)
             ->visit('/topics/' . $post->topic->slug . '/' . $post->topic->id);

        $this->put('/topics/posts/' . $post->id . '/report');

        $this->assertEquals(1, Report::count());

        $this->put('/topics/posts/' . $post->id . '/report');

        $this->assertResponseStatus(302);
        $this->assertEquals(0, Report::count());
    }
}
