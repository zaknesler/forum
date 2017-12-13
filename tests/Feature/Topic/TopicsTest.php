<?php

namespace Tests\Feature\Topic;

use Tests\TestCase;
use App\Models\{Post, Topic, User};
use Illuminate\Foundation\Testing\RefreshDatabase;

class CreateTopicsTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    function can_create_topic()
    {
        $this->authenticate();

        $response = $this->json('POST', '/topics', [
            'title' => 'Such a cool topic!!',
            'body' => 'This topic is not about anything important.',
        ]);

        $response->assertRedirect('/topics/' . Topic::first()->slug);
        $this->assertEquals(1, Topic::count());
    }

    /** @test */
    function can_update_topic()
    {
        $this->authenticate();

        $response = $this->json('POST', '/topics', [
            'title' => 'Such a cool topic!!',
            'body' => 'This topic is not about anything important.',
        ]);

        $this->assertEquals(1, Topic::count());

        $response = $this->json('PATCH', '/topics/1', [
            'title' => 'Such a cool topic!!',
            'body' => 'This is the updated body.'
        ]);

        $response->assertRedirect('/topics/' . Topic::first()->slug);
        $this->assertEquals('This is the updated body.', Topic::first()->body);
    }

    /** @test */
    function can_delete_topic()
    {
        $user = $this->authenticate();
        $topic = factory(Topic::class)->create(['user_id' => $user->id]);

        $response = $this->json('DELETE', '/topics/1');

        $response->assertStatus(200);
        $response->assertJsonStructure(['redirect_url']);
        $this->assertEquals(0, Topic::count());
    }

    /** @test */
    function when_a_topic_title_is_updated_the_slug_stays_the_same()
    {
        $this->authenticate();

        $response = $this->json('POST', '/topics', [
            'title' => 'Such a cool topic!!',
            'body' => 'This topic is not about anything important.',
        ]);

        $response->assertRedirect('/topics/' . Topic::first()->slug);
        $this->assertEquals(1, Topic::count());
        $this->assertEquals('such-a-cool-topic', Topic::first()->slug);

        $response = $this->json('PATCH', '/topics/1', [
            'title' => 'a different title woah!!',
            'body' => 'This topic is not about anything important.',
        ]);

        $response->assertRedirect('/topics/' . Topic::first()->slug);
        $this->assertEquals(1, Topic::count());
        $this->assertEquals('such-a-cool-topic', Topic::first()->slug);
    }

    /** @test */
    function when_a_topic_is_deleted_so_are_its_posts()
    {
        $user = $this->authenticate();
        $topic = factory(Topic::class)->create(['user_id' => $user->id]);
        factory(Post::class, 5)->create(['topic_id' => $topic->id]);

        $this->assertEquals(1, Topic::count());
        $this->assertEquals(5, Post::count());

        $response = $this->json('DELETE', '/topics/1');

        $this->assertEquals(0, Topic::count());
        $this->assertEquals(0, Post::count());
    }
}
