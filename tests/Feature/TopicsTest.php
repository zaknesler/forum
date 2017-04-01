<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Post;
use App\Models\User;
use App\Models\Topic;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class CreateTopicsTest extends TestCase
{
    use DatabaseMigrations;

    /** @test */
    function can_create_topic()
    {
        $this->actingAs(factory(User::class)->create());

        $response = $this->json('POST', '/topics', [
            'title' => 'Such a cool topic!!',
            'body' => 'This topic is not about anything important.',
        ]);

        $response->assertStatus(302);
        $this->assertEquals(1, Topic::count());
    }

    /** @test */
    function can_update_topic()
    {
        $this->actingAs(factory(User::class)->create());

        $response = $this->json('POST', '/topics', [
            'title' => 'Such a cool topic!!',
            'body' => 'This topic is not about anything important.',
        ]);

        $response->assertStatus(302);
        $this->assertEquals('This topic is not about anything important.', Topic::first()->body);

        $response = $this->json('PATCH', '/topics/1', [
            'title' => 'Such a cool topic!!',
            'body' => 'This is the updated body.'
        ]);

        $response->assertStatus(302);
        $this->assertEquals('This is the updated body.', Topic::first()->body);
    }

    /** @test */
    function can_delete_topic()
    {
        $user = factory(User::class)->create();
        $topic = factory(Topic::class)->create(['user_id' => $user->id]);

        $this->actingAs($user);
        $response = $this->json('DELETE', '/topics/1');

        $response->assertStatus(200);
        $response->assertJsonStructure(['redirect_url']);
        $this->assertEquals(0, Topic::count());
    }

    /** @test */
    function when_a_topic_title_is_updated_the_slug_stays_the_same()
    {
        $this->actingAs(factory(User::class)->create());

        $response = $this->json('POST', '/topics', [
            'title' => 'Such a cool topic!!',
            'body' => 'This topic is not about anything important.',
        ]);

        $response->assertStatus(302);
        $this->assertEquals(1, Topic::count());
        $this->assertEquals('such-a-cool-topic', Topic::first()->slug);

        $response = $this->json('PATCH', '/topics/1', [
            'title' => 'a different title woah!!',
            'body' => 'This topic is not about anything important.',
        ]);

        $response->assertStatus(302);
        $this->assertEquals(1, Topic::count());
        $this->assertEquals('such-a-cool-topic', Topic::first()->slug);
    }

    /** @test */
    function when_a_topic_is_deleted_so_are_its_posts()
    {
        $user = factory(User::class)->create();
        $topic = factory(Topic::class)->create(['user_id' => $user->id]);
        factory(Post::class, 5)->create(['topic_id' => $topic->id]);

        $this->assertEquals(1, Topic::count());
        $this->assertEquals(5, Post::count());

        $this->actingAs($user);
        $response = $this->json('DELETE', '/topics/1');

        $this->assertEquals(0, Topic::count());
        $this->assertEquals(0, Post::count());
    }
}
